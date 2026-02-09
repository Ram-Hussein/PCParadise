
<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="sell-container">
            <h2 class="text-center mb-4" style="color: #6a5b6e; font-weight: 800;">Sell Your Component</h2>
            <p class="text-center text-muted mb-5">Turn your unused hardware into cash. Fill out the details below to list your item.</p>

            <form id="sellForm" class="needs-validation" novalidate>
                
                <!-- 1. Basic Information -->
                <h4 class="section-title">Basic Information</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" placeholder="e.g. Nvidia GeForce RTX 3070 Founders Edition" required>
                        <div class="invalid-feedback">Please provide a product name.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" required onchange="updateSpecs()">
                            <option value="" selected disabled>Select Category...</option>
                            <option value="GPU">Graphics Card (GPU)</option>
                            <option value="CPU">Processor (CPU)</option>
                            <option value="RAM">Memory (RAM)</option>
                            <option value="Motherboard">Motherboard</option>
                            <option value="Storage">Storage (SSD/HDD)</option>
                            <option value="PSU">Power Supply</option>
                            <option value="Case">Case</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="invalid-feedback">Please select a category.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" placeholder="e.g. ASUS, MSI, Corsair" required>
                        <div class="invalid-feedback">Please provide the brand.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price ($)</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" min="0" step="0.01" placeholder="0.00" required>
                            <div class="invalid-feedback">Please enter a valid price.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="condition" class="form-label">Condition</label>
                        <select class="form-select" id="condition" required>
                            <option value="" selected disabled>Select Condition...</option>
                            <option value="New">Brand New (Sealed)</option>
                            <option value="LikeNew">Like New (Open Box)</option>
                            <option value="Used">Used (Good)</option>
                            <option value="Fair">Used (Fair)</option>
                            <option value="ForParts">For Parts/Not Working</option>
                        </select>
                    </div>
                </div>

                <!-- 2. Dynamic Technical Specs -->
                <div id="dynamicSpecsSection" class="mb-4 d-none">
                    <h4 class="section-title">Technical Specifications</h4>
                    <div class="row g-3 p-3 bg-light rounded border" id="dynamicSpecsContainer">
                        <!-- JS will inject inputs here -->
                    </div>
                </div>

                <!-- 3. Details & Media -->
                <h4 class="section-title">Details & Media</h4>
                <div class="mb-4">
                    <label for="description" class="form-label">Item Description</label>
                    <textarea class="form-control" id="description" rows="5" placeholder="Describe the condition, usage history, and any included accessories..." required></textarea>
                    <div class="invalid-feedback">Please provide a description.</div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Main Photo (Cover)</label>
                        <input type="file" class="form-control" id="mainPhoto" accept="image/*" required>
                        <div class="form-text">This will be the first image buyers see.</div>
                        <div class="invalid-feedback">Main photo is required.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Additional Photos (Optional)</label>
                        <input type="file" class="form-control" id="otherPhotos" accept="image/*" multiple>
                        <div class="form-text">You can select multiple files.</div>
                    </div>
                </div>

                <!-- 4. Contact Information -->
                <h4 class="section-title">Contact Information</h4>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label for="contactMethod" class="form-label">Preferred Contact Method</label>
                        <select class="form-select" id="contactMethod" required>
                            <option value="Email">Email</option>
                            <option value="Phone">Phone Number</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="contactValue" class="form-label">Contact Details</label>
                        <input type="text" class="form-control" id="contactValue" placeholder="Enter email or phone..." required>
                        <div class="invalid-feedback">Please provide contact details.</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2">
                    <button class="btn btn-submit btn-lg shadow-sm" type="submit">
                        <i class="fas fa-check-circle me-2"></i> List Item for Sale
                    </button>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        // Dynamic Specs Logic
        function updateSpecs() {
            const category = document.getElementById('category').value;
            const container = document.getElementById('dynamicSpecsContainer');
            const section = document.getElementById('dynamicSpecsSection');
            
            // Clear previous inputs
            container.innerHTML = '';
            
            // Define templates for categories
            let inputs = '';

            if (category === 'GPU') {
                inputs = `
                    <div class="col-md-6">
                        <label class="form-label">VRAM Amount (GB)</label>
                        <input type="text" class="form-control" placeholder="e.g. 8GB, 12GB">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Memory Type</label>
                        <select class="form-select">
                            <option>GDDR6X</option>
                            <option>GDDR6</option>
                            <option>GDDR5</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Chipset</label>
                        <input type="text" class="form-control" placeholder="e.g. RTX 3070">
                    </div>
                `;
            } else if (category === 'CPU') {
                inputs = `
                    <div class="col-md-6">
                        <label class="form-label">Core Count</label>
                        <input type="number" class="form-control" placeholder="e.g. 8">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Socket Type</label>
                        <input type="text" class="form-control" placeholder="e.g. LGA 1700, AM5">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Clock Speed (GHz)</label>
                        <input type="text" class="form-control" placeholder="e.g. 3.5 GHz">
                    </div>
                `;
            } else if (category === 'RAM') {
                inputs = `
                    <div class="col-md-6">
                        <label class="form-label">Memory Type</label>
                        <select class="form-select">
                            <option>DDR5</option>
                            <option>DDR4</option>
                            <option>DDR3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Capacity (GB)</label>
                        <input type="number" class="form-control" placeholder="e.g. 16, 32">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Speed (MHz)</label>
                        <input type="number" class="form-control" placeholder="e.g. 3200, 6000">
                    </div>
                `;
            } else if (category === 'Motherboard') {
                inputs = `
                    <div class="col-md-6">
                        <label class="form-label">Form Factor</label>
                        <select class="form-select">
                            <option>ATX</option>
                            <option>Micro-ATX</option>
                            <option>Mini-ITX</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Socket</label>
                        <input type="text" class="form-control" placeholder="e.g. LGA 1700">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Chipset</label>
                        <input type="text" class="form-control" placeholder="e.g. Z790, B650">
                    </div>
                `;
            } else if (category === 'Storage') {
                inputs = `
                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <select class="form-select">
                            <option>NVMe M.2 SSD</option>
                            <option>SATA SSD</option>
                            <option>HDD (Hard Drive)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Capacity</label>
                        <input type="text" class="form-control" placeholder="e.g. 1TB, 500GB">
                    </div>
                `;
            } else {
                // Generic specs for other items
                inputs = `
                    <div class="col-12">
                        <label class="form-label">Key Specification</label>
                        <input type="text" class="form-control" placeholder="Enter key feature...">
                    </div>
                `;
            }

            // Show section and inject HTML if category is selected
            if (category) {
                section.classList.remove('d-none');
                container.innerHTML = inputs;
            } else {
                section.classList.add('d-none');
            }
        }

        // Form Validation Logic
        (function () {
            'use strict'
            var form = document.getElementById('sellForm');
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault(); // Prevent actual submission for demo
                    alert('Your product has been listed successfully! (Demo)');
                    // window.location.href = 'products.html'; 
                }
                form.classList.add('was-validated');
            }, false);
        })()
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/sell.blade.php ENDPATH**/ ?>