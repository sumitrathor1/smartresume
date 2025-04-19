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
        const formHTML = `
            <h2 class="text-center mb-4">Resume Builder - Template ${template}</h2>
            <form id="resumeForm" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="job_title" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Upload Profile Picture</label>
                        <input type="file" name="profile_picture" accept="image/*" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Skills (comma separated)</label>
                        <input type="text" name="skills" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Experience</label>
                        <textarea name="experience" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Education</label>
                        <textarea name="education" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Generate Resume</button>
                    </div>
                </div>
            </form>
        `;

        formArea.innerHTML = formHTML;

        const form = document.getElementById("resumeForm");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append("template_id", template);

            try {
                const response = await fetch("assets/pages/api/_generate-resume.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (result.status === "success") {
                    formArea.innerHTML = "";
                    outputArea.innerHTML = result.message;
                    showLiveAlert("Resume generated successfully!", "success");
                } else {
                    showLiveAlert(result.message || "Something went wrong", "danger");
                }
            } catch (error) {
                console.error("Error generating resume:", error);
                showLiveAlert("Network or server error", "danger");
            }
        });
    };

    renderForm(templateId); // You should define templateId globally or get it from query param
});
