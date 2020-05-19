$('.delete-tournament-button').on('click', function () {
    $('#delete-tournament-form').attr('action', $(this).data('delete-link'));
});

/**
 * Funkcija koja postavlja kolačić zadatog imena, vrednosti, trajanja
 * @param name String
 * @param value String
 * @param days double
 * 
 * @author Natalija Mitić 0085/2017
 * @version 1.0
 */
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

/**
 * Funkcija koja postavlja pamti link u kolačiću
 * @param id String
 * 
 * @author Natalija Mitić 0085/2017
 * @version 1.0
 */
function saveLink(id) {
    setCookie("tournamentPage", id, 1);
}

/**
 * Funkcija koja dohvata kolačić zadatog imena
 * @param name String
 * 
 * @return String
 * 
 * @author Natalija Mitić 0085/2017
 * @version 1.0
 */
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/**
 * Funkcija koja briše kolačić zadatog imena
 * 
 * @author Natalija Mitić 0085/2017
 * @version 1.0
 */
function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

/**
 * Funkcija koja postavlja url za povratak natrag
 * 
 * @author Natalija Mitić 0085/2017
 * @version 1.0
 */
$(document).ready(() => {
    backBtn = $("#backButton");
    if (backBtn.length == 1) {
        prevUrl = getCookie("tournamentPage");
        if (prevUrl)
            backBtn.attr("href", getCookie("tournamentPage"));
    }
})