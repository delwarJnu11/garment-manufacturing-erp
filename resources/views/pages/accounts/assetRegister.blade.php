<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Register Form</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery and Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Asset Register</h2>
            <form id="asset-form">
                <div class="form-group">
                    <label for="asset-name">Asset Name</label>
                    <input type="text" class="form-control" id="asset-name" name="asset-name" required>
                    <div class="invalid-feedback">Asset name is required.</div>
                </div>

                <div class="form-group">
                    <label for="asset-type">Asset Type</label>
                    <select class="form-control" id="asset-type" name="asset-type" required>
                        <option value="">Select Asset Type</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Printer">Printer</option>
                        <option value="Vehicle">Vehicle</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                    <div class="invalid-feedback">Asset type is required.</div>
                </div>

                <div class="form-group">
                    <label for="purchase-date">Purchase Date</label>
                    <input type="date" class="form-control" id="purchase-date" name="purchase-date" required>
                    <div class="invalid-feedback">Purchase date is required.</div>
                </div>

                <div class="form-group">
                    <label for="purchase-price">Purchase Price ($)</label>
                    <input type="number" class="form-control" id="purchase-price" name="purchase-price" required>
                    <div class="invalid-feedback">Purchase price is required.</div>
                </div>

                <div class="form-group">
                    <label for="asset-status">Asset Status</label>
                    <select class="form-control" id="asset-status" name="asset-status" required>
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Disposed">Disposed</option>
                    </select>
                    <div class="invalid-feedback">Asset status is required.</div>
                </div>

                <div class="form-group">
                    <label for="asset-description">Description</label>
                    <textarea class="form-control" id="asset-description" name="asset-description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register Asset</button>
            </form>
        </div>
    </div>

    <!-- jQuery for form validation -->
    <script>
        $(document).ready(function () {
            // Submit form with validation
            $("#asset-form").on("submit", function (event) {
                event.preventDefault();
                
                // Check if the form is valid
                if (this.checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    alert("Asset registered successfully!");
                }

                // Add bootstrap 'was-validated' class for showing invalid fields
                this.classList.add("was-validated");
            });
        });
    </script>

</body>

</html>
