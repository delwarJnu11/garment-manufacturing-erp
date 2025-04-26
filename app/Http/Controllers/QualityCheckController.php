<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductionWorkOrder;
use App\Models\QualityCheck;
use App\Models\Role;
use App\Models\User;
use App\Models\Wastage;
use App\Notifications\QualityCheckCompleted;
use App\Services\WastageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class QualityCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qcProducts = QualityCheck::with(['order'])->paginate(3);

        return view('pages.production.qc.index', compact('qcProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'work_order_id' => 'required|exists:production_work_orders,id',
            ]);

            DB::beginTransaction();

            $workOrder = ProductionWorkOrder::with('order')->findOrFail($request->work_order_id);

            // Check if QC already exists for this work order
            if (QualityCheck::where('work_order_id', $workOrder->id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quality Check already initiated for this Work Order.',
                ], 400);
            }

            // Ensure the order exists
            if (!$workOrder->order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Associated order not found.',
                ], 404);
            }

            // Update QC status on work order
            $workOrder->qc_status = 'In Progress';
            $workOrder->save();

            // Create Quality Check entry
            QualityCheck::create([
                'order_id' => $workOrder->order->id,
                'work_order_id' => $workOrder->id,
                'total_quantity' => $workOrder->total_pieces,
                'checked_quantity' => 0,
                'passed_quantity' => 0,
                'rejected_quantity' => 0,
                'remarks' => null,
                'status' => 'Pending',
                'checked_by' => Auth::id(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quality Check initiated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(QualityCheck $qualityCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QualityCheck $qualityCheck, $id)
    {
        $qualityCheck = QualityCheck::with('order')->find($id);
        return view('pages.production.qc.edit', compact('qualityCheck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QualityCheck $qualityCheck)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'total_quantity' => 'required|integer|min:1',
            'checked_quantity' => 'required|integer|min:0',
            'passed_quantity' => 'required|integer|min:0',
            'rejected_quantity' => 'required|integer|min:0',
            'status' => 'required|in:Pending,In Progress,Completed',
            'remarks' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        $section = 'QC';

        try {
            $workOrder  =  ProductionWorkOrder::find($request->work_order_id);
            // Wastage Create
            if ($request->rejected_quantity > 0) {
                $wastageService = new WastageService();

                $productId = OrderDetail::where('order_id', $request->order_id)->first()?->product_id;

                // find wastage based on Order id
                $result = Wastage::where('order_id', $request->order_id)->where('section', $section)->exists();

                if (!$result) {
                    $wastageService->createWastage([
                        'order_id' => $request->order_id,
                        'product_id' => $productId,
                        'work_order_id' => $request->work_order_id,
                        'quantity' => $request->rejected_quantity,
                        'section' => $section,
                        'wastage_type_name' => 'QC Fail',
                        'remarks' => $request->remarks,
                        'is_sellable' => false,
                    ]);

                    // Update Work Order Wastage
                    $workOrder->wastage = ($workOrder->wastage ?? 0) + $request->rejected_quantity;
                    $workOrder->save();
                } else {
                    $wastage = Wastage::where('order_id', $request->order_id)->where('section', $section)->first();
                    $newQty = $wastage->quantity + $request->rejected_quantity;

                    $wastage->quantity = $newQty;
                    $wastage->save();

                    // Update Work Order Wastage
                    $workOrder->wastage = ($workOrder->wastage ?? 0) + $request->rejected_quantity;
                    $workOrder->save();
                }
            }

            $qualityCheck = QualityCheck::find($request->id);
            // dd($qualityCheck);
            // Calculate Wastage Quantity
            $wastageQty = ($request->rejected_quantity ?? 0) + ($qualityCheck->rejected_quantity ?? 0);

            // Sewing update
            $qualityCheck->update([
                'checked_quantity' => $request->checked_quantity,
                'passed_quantity' => $request->passed_quantity,
                'rejected_quantity' => $wastageQty,
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            // Update Work Order Status if Completed
            if ($request->status == 'Completed') {
                $workOrder->update([
                    'qc_status' => 'Completed'
                ]);
            } else {
                $workOrder->update([
                    'qc_status' => $request->status
                ]);
            }

            if ($request->total_quantity == $request->checked_quantity) {
                // here send a notification in the Packaging Menu
                $roleId = Role::where('name', 'Admin')->first()?->id;
                if ($roleId) {
                    $packagingUsers = User::where('role_id', $roleId)->get();
                } else {
                    throw new \Exception('Packaging Manager role not found.');
                }

                // Get Order Number from Order Table based on Order ID
                $orderNumber = Order::find($request->order_id)->first()?->order_number;

                Notification::send($packagingUsers, new QualityCheckCompleted($workOrder, $orderNumber));
            }

            DB::commit();

            return redirect()->route('qc.index')->with('success', 'Qc Check Started.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QualityCheck $qualityCheck)
    {
        //
    }
}
