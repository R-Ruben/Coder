//Show/unshow posts with pLanguage
function togglePLanguage(pLanguage) {
    if ($('input[type=checkbox].toggle_' + pLanguage + '').prop('checked')) {
        $('.' + pLanguage + '').css('display', 'table-row');

    } else {
        $('.' + pLanguage + '').css('display', 'none');

    }

}

//Collapse post
function collapseCreate() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight = content.scrollHeight + "px";
    }

}

//Toggle payment type, fixed - open
function togglePrice() {
    if ($('#payment-price').css('display') === 'block') {
        $('#payment-price').css('display', 'none');
    } else {
        $('#payment-price').css('display', 'block');
    }

}

window.onload = function () {
    //Open mmotivation popup on "My projects" page
    var motivationPopup = document.getElementsByClassName('motivation');
    for (var i = 0; i < motivationPopup.length; i++) {
        motivationPopup[i].addEventListener('click', function () {
            var container = this.nextElementSibling;
            container.style.display = "block";
        });
    }

    //Close motivation popup
    var popupContainer = document.getElementsByClassName('popup-container');
    for (var i = 0; i < popupContainer.length; i++) {
        popupContainer[i].addEventListener('click', function () {
            this.style.display = "none";
        });
    }

    //Replace standard file upload buttons
    var uploadBtn = document.getElementsByClassName('upload-replace');
    for (var i = 0; i < uploadBtn.length; i++) {
        uploadBtn[i].addEventListener('click', function () {
            this.nextElementSibling.click();
        });
    }

    //Highlight current tab on "browse" pages
    var currTabLink = document.getElementsByClassName(window.location.pathname.substr(1));
    for (var i = 0; i < currTabLink.length; i++) {
        currTabLink[i].style.background = "#fff";
    }

    //Change like/dislike button color on click
    var likeButtons = document.getElementsByClassName('fa-thumbs-up')
    for (var i = 0; i < likeButtons.length; i++) {
        likeButtons[i].addEventListener('click', function () {
            if (this.style.color == "rgb(85, 255, 170)") {
                this.style.color = "#aaa"
            } else {
                this.style.color = "rgb(85,255,170)";
            }
        });
    }
    var dislikeButtons = document.getElementsByClassName('fa-thumbs-down')
    for (var i = 0; i < dislikeButtons.length; i++) {
        dislikeButtons[i].addEventListener('click', function () {
            if (this.style.color == "rgb(255, 85, 85)") {
                this.style.color = "#aaa"
            } else {
                this.style.color = "rgb(255, 85, 85)";
            }
        });
    }
}

//Mark notifications as read when menu is clicked
function markAsRead(notificationCount) {
    if (notificationCount != 0) {
        $.get('/markAsRead');
    }
}


//Toggle what posts are shown on the home page
function toggleCategories() {
    if ($('input[type=checkbox].toggle_questions').prop('checked')) {
        $('.Questions').css('display', 'block');
    } else {
        $('.Questions').css('display', 'none');
    }

    if ($('input[type=checkbox].toggle_projects').prop('checked')) {
        $('.Projects').css('display', 'block');
    } else {
        $('.Projects').css('display', 'none');
    }

    if ($('input[type=checkbox].toggle_projects').prop('checked')) {
        $('.Project.Releases').css('display', 'block');
    } else {
        $('.Project.Releases').css('display', 'none');
    }

    if ($('input[type=checkbox].toggle_misc').prop('checked')) {
        $('.Miscellaneous').css('display', 'block');
    } else {
        $('.Miscellaneous').css('display', 'none');
    }
}


// function switchTabs(evt, tabName) {
//     // Declare all variables
//     var i, tabcontent, tablinks;

//     // Get all elements with class="tabcontent" and hide them
//     tabcontent = document.getElementsByClassName("tabcontent");
//     for (i = 0; i < tabcontent.length; i++) {
//         tabcontent[i].style.display = "none";
//     }

//     // Get all elements with class="tablinks" and remove the class "active"
//     tablinks = document.getElementsByClassName("tablinks");
//     for (i = 0; i < tablinks.length; i++) {
//         tablinks[i].className = tablinks[i].className.replace(" active", "");
//     }

//     // Show the current tab, and add an "active" class to the button that opened the tab
//     document.getElementById(tabName).style.display = "block";
//     evt.currentTarget.className += " active";
// }
