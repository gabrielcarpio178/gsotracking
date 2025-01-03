<script src="../../scripts/moment-with-locales.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="../../styles/sweetalert2.min.css">
<script src="../../scripts/sweetalert2.all.min.js"></script>
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
    if(!isset($_SESSION['role'])&&$_SESSION['role']!=='storekeeper'){
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

        displayNotification('storekeeper');
        getCountNoti();
        notificationPopUp();

    })
    function openNotification(){
        $("#noti_content").show();
    }
    function closeNotification(){
        $("#noti_content").hide();
    }
    function displayNotification(user){
        $.ajax({
            url: '../../logic/getstorekeepernoti.php',
            type: 'POST',
            data: {
                user
            },
            cache: false,
            success: res=>{
                var datas = JSON.parse(res);
                displayNotificationContent(datas);
            }
        })
    }
    function displayNotificationContent(datas){
        let content_noti = '';
        datas.forEach(data=>{
            content_noti += `
                <div class="noti-message-content ${data.storekeeper==0?'isSeen':''}" onclick="updateIsSeen(${data.id},${data.storekeeper}, ${data.purchase_request_code})">
                    <div class="line-bar"></div>
                    <div class="noti-content-info">
                        <div class="content-message">
                            Purchase request 
                        </div>
                        <div class="item-name-message">
                            Status request: ${data.status}
                        </div>
                        <div class="date-info">
                            ${moment(data.datetime).fromNow()}
                        </div>
                    </div>
                </div>
            `
        })
        $("#data_display").html(content_noti);
    }

    function updateIsSeen(id, isSeen, purchase_request_code){
        $.ajax({
            url: '../../logic/dbisSeenUpdateStorekeeper.php',
            type: 'POST',
            data: {
                id : id,
                isSeen : isSeen
            },
            cache: false,
            success: res=>{
                if(res=='success'){
                    if(isSeen==0){
                        window.location = `/qrcodeupsss/pages/storekeeper/equipment_list.php?data_id=${purchase_request_code}`
                    }
                    displayNotification('storekeeper');
                    getCountNoti()
                }
            }
        })
    }

    function getCountNoti(){
        $.ajax({
            url: '../../logic/dbcountisSeenStorekeeper.php',
            type: 'get',
            data: {
                id : "storekeeper" 
            },
            cache: false,
            success: res=>{
                $("#noti_count").text(res);
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
                let request_data = JSON.parse(parsedData.request_data);
                let request_data_list = JSON.parse(parsedData.request_data_list);
                if(parsedData.noti_type==='purchase_request'&&parsedData.status === 'accept'){
                    Swal.fire({
                    html: `
                        <strong>Request Code:</strong> ${request_data.purchase_request_code}<br/>
                        <strong  style="text-align: left;">Items:</strong> ${request_data_list.map((item, index) => `
                            <div  style="text-align: left;">
                            ${index+1}. Item: ${item.item_name}<br/>
                            Quantity: ${item.quantity}<br/>
                            Price: ${item.price}<br/>
                            specs: ${item.specs}</div><br/>
                        `).join('')}
                        <br/><br/>
                    `
                }).then(()=>{
                    window.location = `/qrcodeupsss/pages/storekeeper/equipment_list.php?data_id=${parsedData.data_id}`
                });
                }
            }catch(error){
                console.error("Failed to handle incoming data", error);
            }    
        })
    }
</script>
