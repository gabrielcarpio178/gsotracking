<style>
    
    .print-content-data{
        background-color: white;
        padding: 0 3%;
        display: flex;
        flex-direction: column;
        font-size: 1.1rem;
        position: relative;
        width: 100%;
        border-radius: 5px/5px;
        margin: 10px 0;
    }
    .cancel{
        position: absolute;
        right: 8px;
        top: 8px;
        width: 25px;
        height: 25px;
        cursor: pointer;
        display: grid;
        place-items: center;
        font-size: 2rem;
    }
    .header-print{
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        gap: 0 10px;
    }
    .header-print > .logo-print{
        width: 5%;
        height: 15vh;
        display: grid;
        place-items: center;
    }
    .header-print > .logo-print > img{
        max-width: 100%;
        max-height: 15vh;
    }
    .watermark-print{
        display: flex;
        width: 95%;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        
    }
    .watermark-print1{
        font-weight: 900;
    }
    .line-print{
        background-color: black;
        height: 2px;
        width: 100%;
    }
    .h1-print{
        margin-left: 5%;
        margin-top: 2%;
        text-transform: uppercase;
    }
    .table-print{
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        margin-top: 1%;
        display: flex;
        flex-direction: column;
        margin-bottom: 1%;
    }
    .first-content-table{
        margin-top: 1%;
        display: flex;
        flex-direction: row;
        height: 20vh;
        width: 100%;
    }
    .department-content{
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        width: 33.33%;
        display: flex;
        flex-direction: row;
    }
    .department-content > .department-label{
        width: 40%;
    }
    .department-label > div, .department-data > div{
        text-align: center;
        display: grid;
        place-items: center;
    }
    .department-label > div{
        height: 50%;
    }
    .department-data{
        width: 60%;
    }
    .department-data > div{
        height: 25%;
        border-bottom: 1.5px solid rgb(0, 0, 0, 0.3);
    }
    .department-data > div:last-child{
        border: none;
    }
    .department-label > .first, .department-label > .second, .department-label > .thrd{
        height: 33.33%;
    }
    .second-table-print{
        margin-top: 10px;
        width: 100%;
    }
    .header-second-table{
        background: rgb(0, 0, 0, 0.3);
        display: flex;
        flex-direction: row;
    }
    .header-second-table div{
        width: 16.67%;
        text-align: center;
        height: 5vh;
        display: grid;
        place-items: center;
        border: 1.5px solid rgb(0, 0, 0, 0.3);
    }
    .body-second-table{
        display: flex;
        flex-direction: row;
    }
    .body-second-table > div{
        width: 16.67%;
        /* height: 50vh; */
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        padding: 10px;
        text-align: center;
        display: grid;
        place-items: center;
    }
    table{
        border-left: none;
        border-right: none;
    }
    td{
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        text-align: center;
    }
    .frth-table-print{
        display: flex;
        flex-direction: row;
        width: 100%;
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        margin-top: 10px;
        margin-bottom: 10px;
        height: 12vh;
    }
    .frth-table-print-1st{
        width: 14%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px 0;
    }
    .same-table-print{
        width: 43%;
        border-bottom: none;
        border-top: none;
        
    }
    .first-row{
        display: flex;
        height: 3vh;
    }
    .first-row > div{
        width: 50%;
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        border-top: none;
    }
    .second-row{
        display: flex;
        height: 2.9vh;
        width: 100%;
        border: 1.5px solid rgb(0, 0, 0, 0.3);
        border-top: none;
        justify-content: center;
    }
    .second-row:last-child{
        border-bottom: none;
    }
    .btn-content{
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: end;
    }
    .btn-content > button{
        width: 15%;
        margin-bottom: 1rem;
        background-color: blue;
        color: white;
        padding: 5px 10px;
        border-radius: 10px/10px;
        cursor: pointer;
    }
    #name_{
        margin-top: 40px;   
    }
    #estimated_unit, #estimated_cost{
        text-align: left;
        margin-top: 80px;   
    }
</style>
<div class="print-content-data">
    <div class="cancel" id="btn_cancel" onclick="cancel()"><i class="fas fa-times"></i></div>
    <section id="print_data">
        <div class="header-print">
            <div class="logo-print">
                <img src="../../styles/images/logo1.png" alt="logo gso">
            </div>
            <div class="watermark-print">
                <div class="watermark-print1">
                    Republic of the Philippines
                    <br>
                    City of Bago
                </div>
                <div class="watermark-print2">
                    City Hall, A. Gonzaga St. Bago City
                    <br>
                    Negros Occidental, PHILIPPINES 6101
                </div>
            </div>
        </div>
        <div class="line-print"></div>
        <h1 class="h1-print">Purchase Request</h1>
        <div class="table-print">
            <div class="first-content-table">
                <div class="department-content">
                    <div class="department-label">
                        <div>
                            Department
                        </div>
                        <div>
                            Section
                        </div>
                    </div>
                    <div class="department-data">
                        <div>
                            Bago City College
                        </div>
                        <div>
                            
                        </div>
                        <div>
                            Bago City
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
                <div class="department-content">
                    <div class="department-label">
                        <div>
                            <div class="first">
                                PR No.
                            </div>
                            <div class="second">
                                SAI No.
                            </div>
                        </div>
                        <div class="thrd">
                            ALOBS No.
                        </div>
                    </div>
                    <div class="department-data">
                        <div>
                            
                        </div>
                        <div>
                            
                        </div>
                        <div>
                            
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
                <div class="department-content">
                    <div class="department-label">
                        <div>
                            <div class="first">
                                Date
                            </div>
                            <div class="second">
                                Date
                            </div>
                        </div>
                        <div class="thrd">
                            Date
                        </div>
                    </div>
                    <div class="department-data">
                        <div>
                            
                        </div>
                        <div id="date_print">
                            
                        </div>
                        <div>
                            
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="second-table-print">
                <div class="header-second-table">
                    <div>Item No.</div>
                    <div>Quantity</div>
                    <div>Unit of Issue</div>
                    <div>Item Description</div>
                    <div>Estimated Unit</div>
                    <div>Estimated Cost</div>
                </div>
                <div class="body-second-table">
                    <div id="item_no"></div>
                    <div id="quantity"></div>
                    <div id="unit_of_issue"></div>
                    <div>  
                        <div><b>Equipment</b></div>
                        <div id="date_"></div>
                        <div id="name_"></div>
                        <div id="item_des"></div>
                    </div>
                    <div>
                        <div id="estimated_unit">
                        </div>
                    </div>
                    <div>
                        <div id="estimated_cost"></div>
                        <div id="total_cost"></div>
                    </div>
                </div>
            </div>

            <div class="thrd">
                <p>Purpose: I want ot bring into your kind notice what we had to shift our company office to a new place as per your instruction. During this shifting process we have lost a lot of our office equipment and some of the office equipment has also been impaired during this process</p>
            </div>

            <div class="frth-table-print">
                <div class="frth-table-print-1st">
                    <div>Signature</div>
                    <div>Printed Name</div>
                    <div>Designation</div>
                </div>
                <div class="same-table-print frth-table-print-2nd">
                    <div class="1st-col">
                        <div class="first-row">
                            <div>Request by:</div>
                            <div></div>
                        </div>
                        <div class="first-row">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="2nd-col">
                        <div class="second-row">
                            <b id="data_name"></b>
                        </div>
                        <div class="second-row" id="position_name">                        
                            
                        </div>
                    </div>
                </div>
                <div class="same-table-print frth-table-print-3rd">
                <div class="1st-col">
                        <div class="first-row">
                            <div>Approved by:</div>
                            <div></div>
                        </div>
                        <div class="first-row">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="2nd-col">
                        <div class="second-row">
                            <b>NICHOLAS M. YULO</b>
                        </div>
                        <div class="second-row">
                            CITY MAYOR
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="btn-content">
        <button onclick="print()" id="btn_print_content"><i class="fas fa-print"></i><span>Print</span></button>
    </div>
</div>