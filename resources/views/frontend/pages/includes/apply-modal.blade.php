<!-- Job Application Modal -->
<div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="border-0 shadow modal-content">
            <!-- Modal Header with Custom Design -->
            <div class="px-4 py-3 text-white border-0 modal-header bg-primary">
                <h5 class="modal-title fs-4" id="applyJobModalLabel">
                    <i class="bi bi-briefcase-fill me-2"></i>Apply for Position
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body with Enhanced Styling -->
            <div class="p-4 modal-body">
                <div class="mb-4 application-progress">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <form id="applyJobForm" class="needs-validation" novalidate action="{{ route('frontend.jobs.apply', ['id' => $job->id]) }}">
                    @csrf
                    <!-- Personal Information Section -->
                    <div class="mb-4 section-group">
                        <h6 class="mb-3 text-primary"><i class="bi bi-person-circle me-2"></i>Personal Information</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="applicantName" name="applicant_name" placeholder="Your Name" required value="{{ $student->name ?? '' }}">
                                    <label for="applicantName">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="applicantEmail" name="applicant_email" placeholder="name@example.com" required value="{{ $student->email ?? '' }}">
                                    <label for="applicantEmail">Email Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="applicantPhone" name="applicant_phone" placeholder="Phone Number" required value="{{ $student->phone ?? '' }}">
                                    <label for="applicantPhone">Phone Number</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Education Section -->
                    <div class="mb-4 section-group">
                        <h6 class="mb-3 text-primary"><i class="bi bi-mortarboard-fill me-2"></i>Education Details</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="Your Degree" required value="{{ $student->latest_degree ?? '' }}">
                                    <label for="degree">Last Degree</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="institute" name="institute" placeholder="Your Institute" required value="{{ $student->latest_institute_name ?? '' }}">
                                    <label for="institute">Institute Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="result" name="result" placeholder="Your Result" required value="{{ $student->latest_degree_cgpa ?? '' }}">
                                    <label for="result">Result (CGPA/Grade)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cover Letter Section -->
                    <div class="mb-4 section-group">
                        <h6 class="mb-3 text-primary"><i class="bi bi-file-text-fill me-2"></i>Cover Letter</h6>
                        <div class="form-floating">
                            <textarea class="form-control" id="coverLetter" name="cover_letter" style="height: 150px" placeholder="Write your cover letter" required></textarea>
                            <label for="coverLetter">Tell us why you're perfect for this role</label>
                        </div>
                    </div>

                    <!-- CV Upload Section -->
                    <div class="mb-4 section-group">
                        <h6 class="mb-3 text-primary"><i class="bi bi-file-earmark-pdf-fill me-2"></i>CV/Resume</h6>

                        @auth('student')
                        <!-- Previous CVs Section (Visible only for logged-in users) -->
                        <div id="previousCvsSection" class="mb-3">
                            <label class="form-label">Select from Previous CVs</label>
                            <select class="form-select form-select-lg" id="previousCvs">
                                <option value="" selected>Choose a previously uploaded CV</option>
                            </select>
                        </div>
                        @endauth

                        <!-- New CV Upload -->
                        <div class="cv-upload-container">
                            <div class="p-4 text-center border-2 border-dashed upload-zone rounded-3 bg-light">
                                <i class="mb-3 bi bi-cloud-arrow-up display-4 text-primary"></i>
                                <h6>Drag & Drop your CV here</h6>
                                <p class="mb-3 text-muted small">or</p>
                                <div class="position-relative">
                                    <input type="file" class="form-control" name="cv_file" id="cvUpload" accept=".pdf,.doc,.docx">
                                    <label for="cvUpload" class="btn btn-outline-primary">
                                        Choose File
                                    </label>
                                </div>
                                <p class="mt-2 text-muted small">Supported formats: PDF, DOC, DOCX (Max 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="px-4 btn btn-primary">
                            <i class="bi bi-send-fill me-2"></i>Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
