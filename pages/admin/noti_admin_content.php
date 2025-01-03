<script src="../../scripts/moment-with-locales.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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

    .noti_bell{
        position: relative;
    }
    .noti_count{
        position: absolute;
        width: 75%;
        height: 35%;
        right: -5px;
        background-color: red;
        border-radius: 50%;
        text-align: center;
        color: white;
        font-weight: 900;
        font-size: 1rem;
    }
    .isSeen{
        background-color: rgba(0, 0, 0, 0.2);
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
        getCountNoti();
        notificationPopUp();
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
                        if(notification_data.request_type==="purchase_request"){
                            content_noti += `
                                <div class="noti-message-content ${notification_data.admin==0?'isSeen':''}" onclick="updateIsSeen(${notification_data.id},${notification_data.admin}, ${notification_data.purchase_request_code}, '${notification_data.notify_type}')">
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
                                <div class="noti-message-content ${notification_data.admin==0?'isSeen':''}" onclick="updateIsSeen(${notification_data.id},${notification_data.admin}, ${notification_data.purchase_request_code}, '${notification_data.notify_type}')">
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



    function getCountNoti(){
        $.ajax({
            url: '../../logic/dbcountisSeenAdmin.php',
            type: 'get',
            data: {
                id : "admin" 
            },
            cache: false,
            success: res=>{
                $("#noti_count").text(res);
            }
        })
        
    }

    function updateIsSeen(id, isSeen, items_id, notify_content){
        $.ajax({
            url: '../../logic/dbisSeenUpdateAdmin.php',
            type: 'POST',
            data: {
                id : id,
                isSeen : isSeen
            },
            cache: false,
            success: res=>{
                var result = JSON.parse(res);
                if(result.message=='success'){
                    if(result.isSeen==1){
                        if(notify_content=='maintenance_content'){
                            window.location = `/qrcodeupsss/pages/admin/equipment.php?equipment_id=${items_id}`
                        }else if(notify_content=='purchase_content'){
                            window.location = `/qrcodeupsss/pages/admin/purchase_request.php?equipment_id=${items_id}`
                        }
                    }
                    getNotificationData();
                    getCountNoti()
                }
            }
        })
    }
    function notificationPopUp(){
        var pusher = new Pusher('65b69d50985fd3578ab3', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            try {
                var parsedData = JSON.parse(data);
                if(parsedData.noti_type==='request_maintenance'){
                    Swal.fire({
                        html: `
                            <div style="line-height: 80%;">
                                <div style="text-align: left;"><b>Name:</b> ${parsedData.fullname}</div><br/>
                                <div style="text-align: left;"><b>Purchase Code:</b> ${parsedData.request_code}</div> <br/>
                                <div style="text-align: left;"><b>Equipment Name:</b> ${parsedData.item_name}</div> <br/>
                                <p style="text-align: left;">Request Equipment Maintenance</p>
                            </div>
                        `
                    }).then(()=>{
                        window.location = `/qrcodeupsss/pages/admin/equipment.php?equipment_id=${parsedData.request_code}`
                    });
                }else if(parsedData.noti_type=="purchase_request_admin"){
                    var items = parsedData.items_name;
                    let items_html = '';
                    items.forEach(item=>{
                        items_html+=`
                            <div>Name: ${item.item_name}</div>
                            <div>Quantity: ${item.quantity}</div>
                            <div>Specs: ${item.specs}</div>
                        `
                    })
                    Swal.fire({
                        html: `
                            <strong>Request Equipment</strong>
                            <strong>Name: </strong> ${parsedData.fullname}<br/>
                            <strong>Purchase Code:</strong> ${parsedData.request_code}<br/>
                            <strong style="text-align: left;">Items:</strong><br/>
                            <div>
                                ${items_html}
                            </div>
                        `
                    }).then(()=>{
                        window.location = `/qrcodeupsss/pages/admin/purchase_request.php?equipment_id=${parsedData.request_code}`
                    });
                }
            }catch(error){
                console.error("Failed to handle incoming data", error);
            }    
        })
    }
</script>
