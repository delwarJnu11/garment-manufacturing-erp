@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Bill Of Materials</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Raw Materials</label>
                            <select name="material_id" class="form-select" id="material_dropdown">
                                <option value="">Select Raw Material</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->material_name }}
                                    </option>
                                @empty
                                    <option value="">No raw material Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size_id" class="form-select" id="size_dropdown">
                                <option value="">Select Size</option>
                                @forelse ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @empty
                                    <option value="">No size Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('size_id')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="quantity_used" class="form-label">Quantity Used:</label>
                            <input type="number" name="quantity_used" id="quantity_used" class="form-control" required>
                            <x-input-error :messages="$errors->get('quantity_used')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Unit</label>
                            <select name="uom_id" class="form-select" id="uom_dropdown">
                                <option value="">Select Unit</option>
                                @forelse ($uoms as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @empty
                                    <option value="">No uom Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('uom_id')" class="mt-2" />
                        </div>
                        <!-- Unit Cost -->
                        <div class="col-md-2 mb-3">
                            <label for="unit_price" class="form-label">Unit Cost:</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" required>
                            <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                        </div>

                        <!-- Wastage -->
                        <div class=" col-md-1 mb-3">
                            <label for="wastage" class="form-label">Wastage</label>
                            <input type="number" name="wastage" id="wastage" class="form-control" required>
                            <x-input-error :messages="$errors->get('wastage')" class="mt-2" />
                        </div>
                        <div class="col-md-1 mt-3">
                            <button id="add_btn" type="button" class="form_btn p-4"
                                style="background: purple !important; color:#fff !important;">
                                <i data-feather="plus" class="feather-edit"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" id="order-items-table">
                    <thead>
                        <tr>
                            <th>Material Name</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Wastage</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-append">

                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    <button type="btn" id="create_btn" class="btn btn-primary">Create BOM</button>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#material_dropdown').on('change', function() {
                const materialId = $(this).val();
                if (materialId) {
                    $.ajax({
                        url: `/api/raw_material/${materialId}`,
                        type: "GET",
                        contentType: "application/json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function(response) {
                            $("#unit_price").val(response.cost_per_unit);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert("Error Getting Raw materials information");
                        }
                    });
                }
            });

            function getBomItems() {
                let items = localStorage.getItem('bomItems');
                return items ? JSON.parse(items) : [];
            }

            // Function to save order items to local storage
            function saveBomItems(items) {
                localStorage.setItem('bomItems', JSON.stringify(items));
            }

            // Function to display order items in the table
            function displayBomItems() {
                let items = getBomItems();
                let tableBody = $('#data-append');
                tableBody.empty();

                items.forEach(function(item, index) {
                    let row = `
                        <tr>
                            <td>${item.material_name}</td>
                            <td>${item.size_name}</td>
                            <td>${item.quantity_used}</td>
                            <td>${item.uom_name}</td>
                            <td>${item.unit_price}</td>
                            <td>${item.wastage}</td>
                            <td>${parseFloat(item.quantity_used * item.unit_price)}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-item" data-index="${index}">Delete</button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            }

            // Initial display of order items on page load
            displayBomItems();

            // Handle Add Btn to add item in the cart
            $('#add_btn').on('click', function(e) {
                e.preventDefault();
                // Get values from dropdowns and input
                const material_id = $("#material_dropdown").val();
                const material_name = $("#material_dropdown option:selected").text();
                const size_id = $("#size_dropdown").val();
                const size_name = $("#size_dropdown option:selected").text();
                const quantity_used = $("#quantity_used").val();
                const uom_id = $("#uom_dropdown").val();
                const uom_name = $("#uom_dropdown option:selected").text();
                const unit_price = $("#unit_price").val();
                const wastage = $("#wastage").val() ?? 0;


                // Create item object
                const newItem = {
                    material_id,
                    material_name,
                    size_id,
                    size_name,
                    quantity_used,
                    uom_id,
                    uom_name,
                    unit_price,
                    wastage
                };

                // Get existing items, add the new item, and save
                let items = getBomItems();
                items.push(newItem);
                saveBomItems(items);

                // Update the display
                displayBomItems();

                // Clear the input fields
                $("#product_dropdown").val('');
                $("#size_dropdown").val('');
                $("#quantity_used").val('');
                $("#uom_dropdown").val('');
                $("#unit_price").val('');
                $("#wastage").val('');
            });

            // Delete item button click event (using event delegation)
            $('#order-items-table tbody').on('click', '.delete-item', function() {
                let index = $(this).data('index');
                let items = getBomItems();

                // Delete the specific index item
                const remaining_items = items.filter((item, i) => i !== index);
                saveBomItems(remaining_items);
                displayBomItems();
            });

            // Create Final Order
            $('#create_btn').on('click', function() {
                const items = getBomItems();
                const newItems = items.map(item => ({
                    material_id: item.material_id,
                    size_id: item.size_id,
                    quantity_used: item.quantity_used,
                    uom_id: item.uom_id,
                    unit_price: item.unit_price,
                    wastage: item.wastage
                }));

                //Total Material cost Calulate By size
                const totalCostBySize = newItems.reduce((acc, item) => {
                    const size = item.size_id;
                    const cost = (((parseFloat(item.wastage) * parseFloat(item.quantity_used)) /
                        100) + parseFloat(item.quantity_used)) * parseFloat(item.unit_price);
                    acc[size] = (acc[size] || 0) + cost;
                    return acc;
                }, {});

                const maxTotalCost = Math.max(...Object.values(totalCostBySize)).toFixed(2);

                $.ajax({
                    url: "/api/bom_details",
                    type: "POST",
                    data: JSON.stringify({
                        items: newItems,
                        material_cost: maxTotalCost,
                    }),
                    contentType: "application/json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.status === 201) {
                            localStorage.clear();
                            return window.location.assign('/bom');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Error saving bom items.");
                    }
                });

            })
        });
    </script>
@endsection
