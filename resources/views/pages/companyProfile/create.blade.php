
<div class="content settings-content" style="transform: none;">
    <div class="page-header settings-pg-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Settings</h4>
                <h6>Manage your company profile settings</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                    <!-- Refresh Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw">
                        <polyline points="1 4 1 10 7 10"></polyline>
                        <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse" data-bs-original-title="Collapse">
                    <!-- Collapse Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <div class="row" style="transform: none;">
        <div class="col-xl-12" style="transform: none;">
            <div class="settings-wrapper d-flex" style="transform: none;">
                <div class="sidebars settings-sidebar theiaStickySidebar" id="sidebar2">
                    <!-- Sidebar menu -->
                </div>
                <div class="settings-page-wrap">
                    <form action="company-settings.html">
                        <div class="setting-title">
                            <h4>Company Profile Settings</h4>
                        </div>
                        <div class="card-title-head">
                            <h6><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-building">
                                    <path d="M3 3h18v18H3z"></path>
                                    <line x1="6" y1="3" x2="6" y2="21"></line>
                                    <line x1="10" y1="3" x2="10" y2="21"></line>
                                    <line x1="14" y1="3" x2="14" y2="21"></line>
                                    <line x1="18" y1="3" x2="18" y2="21"></line>
                                </svg></span>Company Information</h6>
                        </div>
                        <div class="company-pic-upload">
                            <div class="company-pic">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle plus-down-add">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg> Company Logo</span>
                            </div>
                            <div class="new-company-field">
                                <div class="mb-0">
                                    <div class="image-upload mb-0">
                                        <input type="file">
                                        <div class="image-uploads">
                                            <h4>Change Image</h4>
                                        </div>
                                    </div>
                                    <span>For better preview, the recommended size is 450px x 450px. Max size 5MB.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Phone</label>
                                    <input type="text" class="form-control" name="company_phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Email</label>
                                    <input type="email" class="form-control" name="company_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Website</label>
                                    <input type="url" class="form-control" name="company_website">
                                </div>
                            </div>
                        </div>
                        <div class="card-title-head">
                            <h6><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin feather-chevron-up">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg></span>Company Address</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Company Address</label>
                                    <input type="text" class="form-control" name="company_address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="company_country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State/Province</label>
                                    <input type="text" class="form-control" name="company_state">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="company_city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="company_postal_code">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
