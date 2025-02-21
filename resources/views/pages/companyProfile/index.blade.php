
    @extends('layout.backend.main')
    @section('page_content')
    
    
    <div class="container mt-3">
        <h1 class="text-center mb-4 " style="color:#c20dc5">Company Profile</h1>
    
        <form action="{{ route('companyProfile.update', $companyProfile->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="{{ $companyProfile->company_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Established Year</label>
                        <input type="text" class="form-control" name="established_year" value="{{ $companyProfile->established_year }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Company Type</label>
                        <input type="text" class="form-control" name="company_type" value="{{ $companyProfile->company_type }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Business Address</label>
                        <input type="text" class="form-control" name="business_address" value="{{ $companyProfile->business_address }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Head Office</label>
                        <input type="text" class="form-control" name="head_office" value="{{ $companyProfile->head_office }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact_number" value="{{ $companyProfile->contact_number }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $companyProfile->email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" class="form-control" name="website" value="{{ $companyProfile->website }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Factory Size</label>
                        <input type="text" class="form-control" name="factory_size" value="{{ $companyProfile->factory_size }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Production Capacity</label>
                        <input type="text" class="form-control" name="production_capacity" value="{{ $companyProfile->production_capacity }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Number of Employees</label>
                        <input type="text" class="form-control" name="number_of_employees" value="{{ $companyProfile->number_of_employees }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Machinery & Equipment</label>
                        <input type="text" class="form-control" name="machinery_equipment" value="{{ $companyProfile->machinery_equipment }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Product Categories</label>
                        <input type="text" class="form-control" name="product_categories" value="{{ $companyProfile->product_categories }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Export Markets</label>
                        <input type="text" class="form-control" name="export_markets" value="{{ $companyProfile->export_markets }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Major Buyers</label>
                        <input type="text" class="form-control" name="major_buyers" value="{{ $companyProfile->major_buyers }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Certifications</label>
                        <input type="text" class="form-control" name="certifications" value="{{ $companyProfile->certifications }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Sustainability Initiatives</label>
                        <input type="text" class="form-control" name="sustainability_initiatives" value="{{ $companyProfile->sustainability_initiatives }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Compliance Standards</label>
                        <input type="text" class="form-control" name="compliance_standards" value="{{ $companyProfile->compliance_standards }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Lead Time</label>
                        <input type="text" class="form-control" name="lead_time" value="{{ $companyProfile->lead_time }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Shipping Logistics</label>
                        <input type="text" class="form-control" name="shipping_logistics" value="{{ $companyProfile->shipping_logistics }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Payment Terms</label>
                        <input type="text" class="form-control" name="payment_terms" value="{{ $companyProfile->payment_terms }}">
                    </div>
                </div>
            </div>

            
    
            <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
        </form>
    </div>
   
</div>

@endsection