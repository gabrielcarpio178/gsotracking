<script src="../../scripts/moment-with-locales.js"></script>
<style>
    .noti_datas_content{
        display: flex;
        flex-direction: column;
        padding: 1.5%;
    }
    .noti_header{
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 0 20px;
        font-size: 2rem;
        font-weight: bold;
        padding: 0 10px;
        border-bottom: 1.5px solid rgba(0, 0, 0, 0.5);
    }
    .close{
        cursor: pointer;
    }

    .noti_data{
        display: flex;
        flex-direction: column;
        gap: 10px 0;     
        margin-top: 20px;
        overflow: scroll;
        height: 90vh;
        padding: 0 2%;
    }
    .noti-message-content{
        border: 1px solid black;
        border-radius: 10px/10px;
        padding: 2%;
        cursor: pointer;
    }
    .noti-fullname{
        text-transform: capitalize;
    }
    
</style>

<?php 
    if(!isset($_SESSION['role'])&&$_SESSION['role']!=='admin'){
        header("Location: ../../index.php");
    }
?>

<div class="noti_datas_content">
    <div class="noti_header">
        <div class="close" id="btn_close" onclick="closeNotification()">
            <i class="fas fa-times"></i>
        </div>
        <div class="noti-label">Notification</div>
    </div>
    <div class="noti_data" id="data_display">
        
    </div>
</div>

<script>
    $(document).ready(()=>{
        getNotificationData();
    })

    function openNotification(){
        $("#noti_content").show();
    }
    function closeNotification(){
        $("#noti_content").hide();
    }



    function getNotificationData(){
        $.ajax({
            url: '../../logic/getNoticationAdmin.php',
            type: 'GET',
            data: {
                admin: 'admin'
            },
            cache: false,
            success: res=>{
                var notification_datas =  JSON.parse(res);
                notification_datas.sort((a, b)=>{
                    let da = new Date(a.datetime), db = new Date(b.datetime);
                    return da - db;
                }).reverse();
                
                let content_noti = '';
                if(notification_datas.length!=0){
                    notification_datas.forEach(notification_data=>{
                        if(notification_data.type_noti==="purchase_request"){
                            content_noti += `
                                <div class="noti-message-content" onclick="gotoPurchase_request()">
                                    <div class="noti-fullname">
                                        <h2>${notification_data.fullname}</h2>
                                    </div>
                                    <div class="line-bar"></div>
                                    <div class="noti-content-info">
                                        <div class="content-message">
                                            Purchase request 
                                        </div>
                                        <div class="item-name-message">
                                            Status request: ${notification_data.status}
                                        </div>
                                        <div class="date-info">
                                            ${moment(notification_data.datetime).fromNow()}
                                        </div>
                                    </div>
                                </div>
                            `
                        }else{
                            content_noti += `
                                <div class="noti-message-content" onclick="gotoMaintenance()">
                                    <div class="noti-fullname">
                                        <h2>${notification_data.fullname}</h2>
                                    </div>
                                    <div class="line-bar"></div>
                                    <div class="noti-content-info">
                                        <div class="content-message">
                                            Maintenace Request
                                        </div>
                                        <div class="item-name-message">
                                            Item Name: ${notification_data.item_name}
                                        </div>
                                        <div class="date-info">
                                            ${moment(notification_data.datetime).fromNow()}
                                        </div>
                                    </div>
                                </div>
                            `
                        }
                    })
                    
                    
                }else{
                    content_noti = `
                        <div class="noti-message-content">
                            No Notification yet
                        </div>
                    `;
                }
                $("#data_display").html(content_noti);
            }
            
        })
    }

    function gotoPurchase_request(){
        window.location='purchase_request.php'
    }
    function gotoMaintenance(){
        window.location='equipment.php'
    }
</script>
