/**
 * Funkcija za biranje avatara prilikom registracije
 *
 * @author Marko Divjak 0084/2017
 */
function pickedAvatar(avatar) {
    input_pick = document.getElementById('avatar-choice');
    if(input_pick.value != -1) {
        old_choice = document.getElementById('avatar' + input_pick.value);
        old_choice.style.border = "";
    }
    input_pick.value = avatar.id.slice(-1);
    avatar.style.border = "2px solid rgb(36, 82, 151)";
}