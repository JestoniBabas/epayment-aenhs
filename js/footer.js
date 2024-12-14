//default transparent divs for ajax 
const ajaxInnerCover = document.querySelector('#ajaxInnerCover');
const ajaxOuterCover = document.querySelector('#ajaxOuterCover');
//end



    function showMenu(){


        const menuCont = document.querySelector('.menu');

        menuCont.classList.toggle('dropdownMenu');

    }

    //alert notification
    
    const notif_loader = document.querySelector('#notif_loader');
    setInterval(function(){
        fetch('../includes/fetch_notification.php')
        .then(response => response.text())
        .then(res => {
            notif_loader.innerHTML=res;
        });
    }, 1000);

    function trigger_notification(){
        window.location="../controllers/notifications.php";
    }




    
