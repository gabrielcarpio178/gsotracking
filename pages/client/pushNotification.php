<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../scripts/jquery.min.js"></script>
<script>
    getnotiCount(<?=$_SESSION['usercode'] ?>)
    Pusher.logToConsole = true;

    var pusher = new Pusher('65b69d50985fd3578ab3', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        try {
            let parsedData = JSON.parse(data);

            let title = parsedData.status === 'accept' ? "Request Accepted!" : "Request Rejected!";
            let message = parsedData.message;

            // Assuming `request_data` is an array
            let request_data = JSON.parse(parsedData.request_data);
            let request_data_list = JSON.parse(parsedData.request_data_list);
            console.log(parsedData);
            Swal.fire({
                title: title,
                text: message,
                icon: parsedData.status === 'accept' ? "success" : "error",
                html: `
                    <strong>Request Code:</strong> ${request_data.purchase_request_code}<br/>
                    <strong>Items:</strong> ${request_data_list.map((item, index) => `
                        <div>
                        ${index+1}. Item: ${item.item_name}<br/>
                        Quantity: ${item.quantity}<br/>
                        Price: ${item.price}<br/>
                        specs: ${item.specs}</div><br/>
                    `).join('')}
                    <br/><br/>
                `
            });
            getnotiCount(<?=$_SESSION['usercode'] ?>);
        } catch (error) {
            console.error("Failed to handle incoming data", error);
        }
        
    });

    function getnotiCount(id){
        $.ajax({
            url: '../../logic/dbcountisSeen.php',
            type: 'POST',
            data: {
                id : id 
            },
            cache: false,
            success: res=>{
                $("#noti_count").text(res);
            }
        })
    }
</script>