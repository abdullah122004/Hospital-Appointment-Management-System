<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-3">
                    <h4 class="mb-0 fw-bold">Register New Specialist Profile</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="n" class="form-control" placeholder="Dr. John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Specialty</label>
                            <input type="text" name="s" class="form-control" placeholder="Heart Surgeon">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Education Details</label>
                            <textarea name="e" class="form-control" placeholder="MBBS, FCPS, etc."></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Clinic Detail</label>
                            <input type="text" name="c" class="form-control" placeholder="Room 101">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Branch</label>
                            <input type="text" name="b" class="form-control" placeholder="Rawalpindi">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Timings</label>
                            <input type="text" name="t" class="form-control" placeholder="4pm-9pm">
                        </div>
                        <div class="col-12">
                            <button name="add_doc" class="btn btn-primary w-100 py-2 fw-bold shadow">Save Doctor Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>