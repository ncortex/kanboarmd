console.log(window.location);
if( window.location == "https://kanboard-4.herokuapp.com/") {
    window.location.replace("https://kanboard-4.herokuapp.com/?controller=BoardViewController&action=show&project_id=1");
}