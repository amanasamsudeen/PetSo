function Hide_Opportunities() {
    var x = document.getElementById("opportunities");
    if (x.style.display === "flex") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}

function Show_Applications() {
    var x = document.getElementById("article");
    if (x.style.display === "none") {
        x.style.display = "grid";
        Hide_Opportunities();
    } else {
        x.style.display = "none";
    }
}

function Hide_Applications() {
    var x = document.getElementById("article");
    if (x.style.display === "flex") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}

function Show_Opportunities() {
    var x = document.getElementById("opportunities");
    var tag = document.getElementById("vol-tag");
    if (x.style.display === "none") {
        x.style.display = "grid";
        tag.classList.add("active-tag");
        Hide_Applications();
    }
}

// Side panel navigation 

function showVolunteerPanel() {
    var x = document.getElementById("vol-sec");
    var tag = document.getElementById("vol-tag");
    if (x.style.display !== "block") {
        x.style.display = "block";
        tag.classList.add("active-tag");
        hideProjectPanel();
        hideFaundraisingPanel();
        hideAnimalProfilesPanel();
    }
}

function hideProjectPanel() {
    var x = document.getElementById("proj-sec");
    var tag = document.getElementById("proj-tag");
    if (x.style.display !== "none") {
        x.style.display = "none";
        tag.classList.remove("active-tag");
    }
}

function showProjectsPanel() {
    var x = document.getElementById("proj-sec");
    var tag = document.getElementById("proj-tag");
    if (x.style.display !== "block") {
        x.style.display = "block";
        tag.classList.add("active-tag");
        hideVolunteerPanel();
        hideFaundraisingPanel();
        hideVolApplications();
        hideAnimalProfilesPanel();
    }
}

function hideVolunteerPanel() {
    var x = document.getElementById("vol-sec");
    var tag = document.getElementById("vol-tag");
    if (x.style.display !== "none") {
        x.style.display = "none";
        tag.classList.remove("active-tag");
    }
}

function showFaundraisingPanel() {
    var x = document.getElementById("fund-sec");
    var tag = document.getElementById("fund-tag");
    if (x.style.display !== "block") {
        x.style.display = "block";
        tag.classList.add("active-tag");
        hideVolunteerPanel();
        hideProjectPanel();
        hideVolApplications();
        hideAnimalProfilesPanel();
    }
}

function hideFaundraisingPanel() {
    var x = document.getElementById("fund-sec");
    var tag = document.getElementById("fund-tag");
    if (x.style.display !== "none") {
        x.style.display = "none";
        tag.classList.remove("active-tag");
    }
}

function showAnimalProfilesPanel() {
    var x = document.getElementById("animal-sec");
    var tag = document.getElementById("animal-tag");
    if (x.style.display !== "block") {
        x.style.display = "block";
        tag.classList.add("active-tag");
        hideVolunteerPanel();
        hideProjectPanel();
        hideVolApplications();
        hideFaundraisingPanel();
    }
}

function hideAnimalProfilesPanel() {
    var x = document.getElementById("animal-sec");
    var tag = document.getElementById("animal-tag");
    if (x.style.display !== "none") {
        x.style.display = "none";
        tag.classList.remove("active-tag");
    }
}

function showVolApplications() {
    var x = document.getElementById("volApp-sec");
    var tag = document.getElementById("vol-tag");
    if (x.style.display !== "block") {
        x.style.display = "block";
        tag.classList.add("active-tag");
        hideVolunteerPanel();
        hideProjectPanel();
        hideFaundraisingPanel();
        hideAnimalProfilesPanel();
    }
}

function hideVolApplications() {
    var x = document.getElementById("volApp-sec");
    var tag = document.getElementById("vol-tag");
    if (x.style.display !== "none") {
        x.style.display = "none";
        tag.classList.remove("active-tag");
    }
}