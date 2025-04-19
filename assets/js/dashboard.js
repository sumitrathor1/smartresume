function fetchResumes() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "./assets/pages/api/_get-resumes.php", true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const res = JSON.parse(xhr.responseText);
                const resumeContainer = document.getElementById("yourResumes");
                resumeContainer.innerHTML = ""; // Clear old list

                if (res.success && res.resumes.length > 0) {
                    res.resumes.forEach(resume => {
                        const resumeCard = `
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm" style="background-color: #e3f2fd;">
                                <div class="card-body">
                                    <h5 class="card-title">${resume.title}</h5>
                                    <p class="card-text text-muted">Created: ${resume.created}</p>
                                    <a href="view-resume.php?id=${resume.id}" class="btn btn-sm btn-outline-primary">View</a>
                                    <a href="edit-resume.php?id=${resume.id}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>
                    `;
                        resumeContainer.innerHTML += resumeCard;
                    });
                } else {
                    resumeContainer.innerHTML =
                        "<p class='text-muted'>You haven't created any resumes yet.</p>";
                }
            } catch (err) {
                console.log("Error parsing resume data", err);
            }
        } else {
            console.error("Failed to fetch resumes");
        }
    };

    xhr.send();
}


document.addEventListener("DOMContentLoaded", function() {
    // Fetch user credits using AJAX
    function fetchCredits() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "./assets/pages/api/_get-credits.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        document.getElementById("credits-box").textContent = res.credits;
                    } else {
                        document.getElementById("credits-box").textContent = "0";
                        console.log(xhr.responseText)
                    }
                } catch (e) {
                    document.getElementById("credits-box").textContent = "Err";
                }
            } else {
                document.getElementById("credits-box").textContent = "Err";
            }
        };

        xhr.send();
    }
    fetchCredits();
    fetchResumes();
});