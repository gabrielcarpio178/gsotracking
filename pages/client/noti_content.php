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
    }
    .noti-message{
        border: 1.5px solid rgba(0, 0, 0, 0.5);
        border-radius: 5px/5px;
        padding: 5px;
        padding: 10px;
        cursor: pointer;
    }
    .isSeen{
        background-color: rgba(0, 0, 0, 0.2);
    }
    .message-header{
        text-indent: 20px;
        font-size: 1.2rem;
        font-weight: 900;
    }
    .message-body{
        padding: 10px;
        font-size: 1rem;
    }
    .noti-profile-content{
        display: flex;
        flex-direction: row;
        width: 100%;
        align-items: center;
        gap: 0 10px;
    }
    .noti-profile-content > .img-profile{
        width: 15%;
        height: 9vh;
    }
    .noti-profile-content > .img-profile > img{
        max-width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .noti-profile-content > .noti-name-sender{
        font-size: 1.5rem;
    }
    .message-content-noti{
        margin-top: 20px;
    }
</style>
<div class="noti_datas_content">
    <div class="noti_header">
        <div class="close" id="btn_close">
            <i class="fas fa-times"></i>
        </div>
        <div class="noti-label">Notification</div>
    </div>
    <div class="noti_data" id="data_display">
        
    </div>
</div>
<script>
    getNoti(<?=$_SESSION['usercode'] ?>);
    const close_noti =  document.querySelector("#btn_close");
    const noti_content_div =  document.querySelector("#noti_content");

    close_noti.addEventListener('click',()=>{
        noti_content_div.style.display = "none";
    })

    function getNoti(id){
        $.ajax({
            url: '../../logic/dbgetNoti.php',
            type: 'POST',
            data: {
                id : id 
            },
            cache: false,
            success: res=>{
                var notification_datas = JSON.parse(res);
                
                notification_datas.sort((a, b)=>{
                    let da = new Date(a.datetime), db = new Date(b.datetime);
                    return da - db;
                }).reverse();
                displayNoti(notification_datas);
            }
        })
    }
    function displayNoti(datas){
        let data_html = '';
        
        datas.forEach(data=>{
            let action = '';
            if(data.request_type==="purchase_request"){

                if(data.status=='accept'){
                    action = '<p>Storekeeper will notify when the equipment is ready to pick up</p>';
                }else if(data.status=='pending'){
                    action = `<p>Purchase request ${data.status}</p>`;
                }
                data_html += `
                    <div class="noti-message ${(data.client==0)?'isSeen':''}" onclick="updateIsSeen(${data.id},${data.client}, ${data.gotoID}, '${data.gotoContent}')">
                        <div class="noti-profile-content">
                            <div class="img-profile">
                                <img src="../../profile/boy.jpeg" alt="profile">
                            </div>
                            <div class="noti-name-sender">
                                <div class="noti-name-label">Admin</div>
                                <div class="noti-time-label">${moment(data.datetime).fromNow()}</div>
                            </div>
                        </div>
                        <div class="message-content-noti">
                            <div class="message-header">
                                <p>Your purchase request has been ${data.status} by the Admin</p>
                            </div>
                            <div class="message-body">
                                ${action}
                            </div>
                        </div>
                    </div>
                `;

            }else{

                data_html += `
                    <div class="noti-message ${(data.client==0)?'isSeen':''}" onclick="updateIsSeen(${data.id},${data.client}, ${data.gotoID}, '${data.gotoContent}')">
                        <div class="noti-profile-content">
                            <div class="img-profile">
                                <img src="../../profile/boy.jpeg" alt="profile">
                            </div>
                            <div class="noti-name-sender">
                                <div class="noti-name-label">Admin</div>
                                <div class="noti-time-label">${moment(data.datetime).fromNow()}</div>
                            </div>
                        </div>
                        <div class="message-content-noti">
                            <div class="message-body">
                                <div class="message-header">
                                    <p>Your Request Maintenance is ${data.request_status===0?"Waiting for accept":"Accepted"}</p>
                                </div>
                                <p>Equiment name: ${data.item_name}</p>
                            </div>
                        </div>
                    </div>
                `;

            }
        });
        $("#data_display").html(data_html);
    }

    function updateIsSeen(id, isSeen, gotoID, gotoContent){
        $.ajax({
            url: '../../logic/dbisSeenUpdate.php',
            type: 'POST',
            data: {
                id : id,
                isSeen : isSeen
            },
            cache: false,
            success: res=>{
                if(res=='success'){
                    if(isSeen==0){
                        if(gotoContent=='maintenance'){
                            window.location = `/qrcodeupsss/pages/client/request_maintenance.php?data_id=${gotoID}`
                        }else{
                            window.location = `/qrcodeupsss/pages/client/accountability.php?data_id=${gotoID}`
                        }
                    }
                    getNoti(<?=$_SESSION['usercode'] ?>);
                    getnotiCount(<?=$_SESSION['usercode'] ?>);
                }
            }
        })
    }
</script>