@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Bill Of Materials</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bom.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select a Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product['order_id'] }}">{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Labour Cost</label>
                            <input class="form-control" type="number" name="labour_cost" id="labour_cost"
                                value="{{ old('labour_cost') }}">
                            <x-input-error :messages="$errors->get('labour_cost')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Overhead Cost</label>
                            <input class="form-control" type="number" name="overhead_cost" id="overhead_cost"
                                value="{{ old('overhead_cost') }}">
                            <x-input-error :messages="$errors->get('overhead_cost')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Utility Cost</label>
                            <input class="form-control" type="number" name="utility_cost" id="utility_cost"
                                value="{{ old('utility_cost') }}">
                            <x-input-error :messages="$errors->get('utility_cost')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layout.backend.main') 

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Bill Of Materials</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bom.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="order_id" class="form-label">Order ID (Optional)</label>
                        <input type="number" class="form-control" name="order_id" id="order_id"
                            value="{{ old('order_id') }}">
                    </div>

                    <div class="mb-3">
                        <label for="material_cost" class="form-label">Material Cost</label>
                        <input type="number" class="form-control" name="material_cost" id="material_cost" step="0.01"
                            value="{{ old('material_cost') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="labor_cost" class="form-label">Labor Cost</label>
                        <input type="number" class="form-control" name="labor_cost" id="labor_cost" step="0.01"
                            value="{{ old('labor_cost') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="overhead_cost" class="form-label">Overhead Cost</label>
                        <input type="number" class="form-control" name="overhead_cost" id="overhead_cost" step="0.01"
                            value="{{ old('overhead_cost') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="utility_cost" class="form-label">Utility Cost</label>
                        <input type="number" class="form-control" name="utility_cost" id="utility_cost" step="0.01"
                            value="{{ old('utility_cost') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_cost" class="form-label">Total Cost</label>
                        <input type="number" class="form-control" name="total_cost" id="total_cost" step="0.01"
                            value="{{ old('total_cost') }}" required>
                    </div>

                    <h2 class="mt-4">Materials Used</h2>

                    <table class="table table-bordered" id="materials-table">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Size</th>
                                <th>Quantity Used</th>
                                <th>Unit Cost</th>
                                <th>Wastage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="material-row">
                                <td>
                                    <select name="materials[0][material_id]" class="form-select" required>
                                        <option value="">Select Material</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="materials[0][size_id]" class="form-select" required>
                                        <option value="">Select Size</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="materials[0][quantity_used]"
                                        step="0.01" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="materials[0][unit_cost]" step="0.01"
                                        required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="materials[0][wastage]" step="0.01"
                                        required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-material">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-success" id="add-material">Add Material</button>

                    <button type="submit" class="btn btn-primary">Save BOM</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addMaterialButton = document.getElementById('add-material');
            const materialsTable = document.getElementById('materials-table');
            let materialCount = 1;

            addMaterialButton.addEventListener('click', function() {
                const newRow = materialsTable.querySelector('.material-row').cloneNode(true);

                newRow.querySelectorAll('input, select').forEach(element => {
                    element.value = '';
                });

                newRow.querySelectorAll('input, select').forEach(element => {
                    const name = element.getAttribute('name');
                    if (name) {
                        element.setAttribute('name', name.replace(/\[0]/g, `[${materialCount}]`));
                    }
                });

                materialsTable.querySelector('tbody').appendChild(newRow);
                newRow.querySelector('.remove-material').addEventListener('click', removeMaterialRow);
                materialCount++;
            });

            document.querySelector('.remove-material').addEventListener('click', removeMaterialRow);

            function removeMaterialRow(event) {
                event.target.closest('tr').remove();
            }
        });
    </script>
@endsection --}}
