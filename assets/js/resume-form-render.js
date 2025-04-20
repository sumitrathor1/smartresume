function showLiveAlert(message, type = "success") {
    const alertPlaceholder = document.getElementById("liveAlertPlaceholder");

    const wrapper = document.createElement("div");
    wrapper.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    alertPlaceholder.append(wrapper);

    setTimeout(() => {
        const alert = bootstrap.Alert.getOrCreateInstance(wrapper.querySelector('.alert'));
        alert.close();
    }, 4000);
}

document.addEventListener("DOMContentLoaded", () => {
    const formArea = document.getElementById("resume-form-area");
    const outputArea = document.getElementById("resume-output");

    const renderForm = (template) => {
        let formHTML = "";
        if(template === '1'){
        formHTML = `
     <section class="d-flex align-items-center justify-content-center" style="min-height: 85vh; background-color: #ffffff;">
  <div class="card shadow p-4" style="width: 100%; max-width: 900px; border-radius: 1rem; background-color: #e3f2fd;">
    <h2 class="text-center mb-4 fw-bold">Resume Builder - Template ${template}</h2>

    <form id="resumeForm" enctype="multipart/form-data">
      <div class="row g-3">

        <!-- Basic Info -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Full Name<span class="text-danger">*</span></label>
          <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Job Title<span class="text-danger">*</span></label>
          <input type="text" name="job_title" class="form-control" required>
        </div>

        <div class="col-md-12">
          <label class="form-label fw-semibold">Upload Profile Picture<span class="text-danger">*</span></label>
          <input type="file" name="profile_picture" accept="image/*" class="form-control" required>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Phone<span class="text-danger">*</span></label>
          <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="col-md-12">
          <label class="form-label fw-semibold">Address</label>
          <input type="text" name="address" class="form-control">
        </div>

        <!-- Profile Summary -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Professional Summary<span class="text-danger">*</span></label>
          <textarea name="summary" class="form-control" rows="3" placeholder="Write a short bio about yourself..." required></textarea>
        </div>

        <!-- Skills & Languages -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Skills <small>(comma separated)</small><span class="text-danger">*</span></label>
          <input type="text" name="skills" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Languages <small>(e.g., English: Fluent, Spanish: Intermediate)</small></label>
          <input type="text" name="languages" class="form-control">
        </div>

        <!-- Work Experience -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Work Experience</label>
          <textarea name="experience" class="form-control" rows="5" placeholder="List company name, job title, dates, and key responsibilities."></textarea>
        </div>

        <!-- Education -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Education<span class="text-danger">*</span></label>
          <textarea name="education" class="form-control" rows="5" placeholder="Include degrees, schools, dates, and GPA if any." required></textarea>
        </div>

        <!-- Social Links -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">LinkedIn Profile</label>
          <input type="url" name="linkedin" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Website / Portfolio</label>
          <input type="url" name="website" class="form-control">
        </div>

        <!-- Submit -->
        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-dark">Generate Resume</button>
        </div>

      </div>
    </form>
  </div>
</section>
        `;
    }
    else if(template === '2'){
        formHTML = `
        <!-- Resume Builder Form for Template 2 -->
<section class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #ffffff;">
  <div class="card shadow p-4" style="width: 100%; max-width: 900px; border-radius: 1rem; background-color: #e3f2fd;">
    <h2 class="text-center mb-4 fw-bold">Resume Builder - Template 2</h2>

    <form id="resumeForm" enctype="multipart/form-data">
      <div class="row g-3">

        <!-- Basic Info -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Full Name<span class="text-danger">*</span></label>
          <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Job Title<span class="text-danger">*</span></label>
          <input type="text" name="job_title" class="form-control" required>
        </div>

        <!-- Contact Info -->
        <div class="col-md-4">
          <label class="form-label fw-semibold">Address</label>
          <input type="text" name="address" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Website</label>
          <input type="url" name="website" class="form-control">
        </div>

        <!-- Summary -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Professional Summary<span class="text-danger">*</span></label>
          <textarea name="summary" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Skills -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Technical Skills <small>(comma separated)<span class="text-danger">*</span></small></label>
          <input type="text" name="skills" class="form-control" required>
        </div>

        <!-- Experience -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Work Experience</label>
          <textarea name="experience" class="form-control" rows="5" placeholder="Company Name, Role, Dates, Responsibilities"></textarea>
        </div>

        <!-- Education -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Education<span class="text-danger">*</span></label>
          <textarea name="education" class="form-control" rows="4" placeholder="Degree, Institution, Dates, Notes" required></textarea>
        </div>

        <!-- Additional Info -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Languages</label>
          <input type="text" name="languages" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Certifications / Awards</label>
          <textarea name="certifications" class="form-control" rows="2"></textarea>
        </div>

        <!-- Submit -->
        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-dark">Generate Resume</button>
        </div>

      </div>
    </form>
  </div>
</section>

        `;
    }
    else if(template === '3'){
        formHTML = `<!-- Resume Builder Form for Template 3 -->
<section class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="card shadow p-4" style="width: 100%; max-width: 960px; border-radius: 1rem; background-color: #e3f2fd;">
    <h2 class="text-center mb-4 fw-bold">Resume Builder - Template 3</h2>

    <form id="resumeForm" enctype="multipart/form-data">
      <div class="row g-3">

        <!-- Name & Title -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Full Name<span class="text-danger">*</span></label>
          <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Job Title<span class="text-danger">*</span></label>
          <input type="text" name="job_title" class="form-control" required>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Phone Number<span class="text-danger">*</span></label>
          <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Address</label>
          <input type="text" name="address" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Website</label>
          <input type="url" name="website" class="form-control">
        </div>

        <!-- Profile Summary -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Profile Summary<span class="text-danger">*</span></label>
          <textarea name="summary" class="form-control" rows="4" required></textarea>
        </div>

        <!-- Education -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Education (Latest to Oldest)<span class="text-danger">*</span></label>
          <textarea name="education" class="form-control" rows="4" placeholder="2029 - 2030, BORCELLE UNIVERSITY, Master of Business Management" required></textarea>
        </div>

        <!-- Work Experience -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Work Experience (Latest to Oldest)</label>
          <textarea name="experience" class="form-control" rows="6" placeholder="Company Name, Role, Dates, Key Responsibilities"></textarea>
        </div>

        <!-- Skills -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Skills <small>(comma separated)<span class="text-danger">*</span></small></label>
          <input type="text" name="skills" class="form-control" required>
        </div>

        <!-- Languages -->
        <div class="col-md-12">
          <label class="form-label fw-semibold">Languages <small>(with proficiency)</small></label>
          <input type="text" name="languages" class="form-control" placeholder="English: Fluent, French: Basic">
        </div>

        <!-- Submit -->
        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-dark">Generate Resume</button>
        </div>

      </div>
    </form>
  </div>
</section>
`;
    }
    else{
        showLiveAlert("Invalid Tamplate Selected...", "danger");
    }

        formArea.innerHTML = formHTML;

        const form = document.getElementById("resumeForm");
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append("template_id", templateId);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "assets/pages/api/_generate-resume.php", true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    let res = {};
                    console.log(xhr.responseText);
                    try {
                        res = JSON.parse(xhr.responseText.trim());
                    } catch (e) {
                        showLiveAlert("Invalid response from server.", "danger");
                        return;
                    }

                    if (res.status === "success") {
                      showLiveAlert("Resume generated successfully!", "success");
                      setTimeout(() => {
                          window.open(res.download, "_blank"); // Open the generated resume in new tab
                      }, 1500);
                    } else {
                        showLiveAlert(res.message || "Something went wrong", "danger");
                    }
                }
            };

            xhr.onerror = function () {
                showLiveAlert("Network error occurred.", "danger");
            };

            xhr.send(formData);

        });
    };

    renderForm(templateId); // You should define templateId globally or get it from query param
});
