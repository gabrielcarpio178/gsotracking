<style>
    .print-content{
        background-color: white;
        display: flex;
        flex-direction: column;
        font-size: 1.1rem;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 5% 8%;
        border-radius: 15px/15px;
    }
    .qr-contents{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    .print-content > .cancel{
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
        padding: 2%;
    }
    .cancel > i{
        font-size: 2.5rem;
    }
    canvas{
        display: none;
        width: 50%;
    }
</style>
<div class="print-content">
    <div class="cancel" id="btn_cancel" onclick="remove_content()"><i class="fas fa-times"></i></div>
    <div class="qr-contents" id="print_canvas">
        <div class="qr-body">
            <div class="qr-fname">Full name: <span id="qr_name"></span></div>
            <div class="qr-item-no">Item No.: <span id="qr_item"></span></div>
            <div class="qr-status">Status.: <span id="qr_status"></span></div>
            <div class="qr-table">
                <table class="qr-body-table">
                    <thead>
                        <tr>
                            <td>Item Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Specs</td>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="btn-content">
        <button id="btn_print_content" class='btn-viem-items' onclick="printCanvas()"><i class="fas fa-print"></i><span>Download</span></button>
        <a id="save_data" style="display: none;"></a>
    </div>
</div>