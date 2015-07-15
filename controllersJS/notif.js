function notifBox(tab)
{
    var lenghtab = 0;
    var tabNotif = new Array();

       for(var valeur in tab){
            for (var val2 in tab[valeur]){
              for(var val3 in tab[valeur][val2]){

                for(var val4 in tab[valeur][val2][val3]){
                var img = val3;
                if(val3 ==""){
                  img = "./profil/unknow.jpg"
                }
                                
                $("#notificationsBody").prepend('<div id="notificationsMess" class="ns-box-inner"><div id="Img"><img width="64" height="64" src="'+img+'"/></div><div id="delete" ><button onclick="notifAction(\'delete\','+valeur+')"><img width="16" height="16" src="style/ImgNot/remove.png"/></button></div><p>'+tab[valeur][val2][val3][val4]+'</br>'+val4+'</p></div>');
                 if(val2 == 0){
                     lenghtab++;
                     tabNotif.push(valeur);
                 }
               }
              }
            }
        }
        if(lenghtab>0){
            $("#notification_count").append(lenghtab);
        }
        else{
          $("#notification_count").hide();  
        }
    $("#notificationLink").click(function ()
    {
        $("#notificationContainer").fadeToggle(100);
        $("#notification_count").fadeOut("slow");

        //Pour mettre la bdd à jour et dire que les messages ont été lus
         for(var val in tabNotif){
          notifAction("update",tabNotif[val]);
        }
        return false;
    });


    $(document).click(function ()
    {
        //hide notification popup on doucument click
        $("#notificationContainer").hide();
    });


    $("#notificationContainer").click(function ()
    {
        return false;
    });

}

function notifAction(type,id){
  var xhr = getXMLHttpRequest();
  xhr.open("GET", "notifSQL.php?request="+type+"&id="+id, true);
  xhr.onreadystatechange = function(aEvt){
        if (xhr.readyState == 4) {
             if(xhr.status == 200)
             {
              if(type!="update"){
                void window.location.reload();
              }
             }
             else
             {
              console.log("Erreur pendant le chargement de la page.\n");
             }
          }

      };
  xhr.send(null); 
}