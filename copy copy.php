<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}

function getItemOptions()
{
    $sql = "SELECT id ,item_name FROM items where DeletedOn is null";
    $result = query_exec($sql);

    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['item_name'] . '</option>';
    }


    return $options;
}
if (isset($_GET["deal_id"])) {
    $_SESSION['id'] = $_GET["deal_id"];

    $query = "SELECT items.item_name,deal_details.*,deal_details.deal_id as update_id FROM `deal_details` INNER JOIN items on deal_details.item_id=items.id WHERE deal_id='$_SESSION[id]' and deal_details.DeletedOn is null ";

    $result = query_exec($query);
}



if (isset($_POST['submit'])) {
    $item_values = $_POST['item'];
    $price_values = $_POST['price'];
    $quantity_values = $_POST['quantity'];
    $total_amount_values = $_POST['total_amount'];


    for ($i = 0; $i < count($item_values); $i++) {
        $item_id = $item_values[$i];
        $price = $price_values[$i];
        $quantity = $quantity_values[$i];
        $total_amount = $total_amount_values[$i];


        $query = "INSERT INTO `deal_details`(`item_id`, `deal_id`, `quantity`, `price`, `total_amount` ,`CreatedBy`) 
    VALUES ('$item_id','$_SESSION[id]','$quantity','$price','$total_amount', ' $_SESSION[login]')";
        $result = query_exec($query);
        if ($result) {
            redirect("deal.php");
        } else {
            echo "Error:";
        }
    }
}
if (isset($_POST['delete'])) {
    $rowId = $_POST['delete']; // Get the ID of the row to delete

    $query = "UPDATE `deal_details` SET `DeletedOn`=NOW() ,`DeletedBy`='$_SESSION[login]' WHERE `id`='$rowId' AND `deal_id`='$_SESSION[id]'";
    $result = query_exec($query);
    if ($result) {
        // Redirect to the same page after deletion
        redirect("deal.php?deal_id=$_SESSION[id]");
    } else {
        echo "Error deleting row with ID $rowId. Please try again.";
    }
}









?>




<?php include("headerlinks.php") ?>

<body>
    <style>
    .list {
        padding: 0;
        margin: 0;
    }

    .list li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        letter-spacing: 1.5px;

    }

    #delete {
        padding: 10px 20px;

        border: none;
        cursor: pointer;
        margin-left: auto;
    }

    /* Optionally, add back the bullet points for the list */
    .list li:before {
        content: "\25A0";
        /* Unicode bullet character */
        margin-right: 5px;
        /* Add some space between the bullet and the text */
    }
    </style>
    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main">
            <div class="content-header">
                <div>
                    <a href="deal.php" class="btn btn-outline-danger"> &times; Discard</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table ">


                                <h5 class="content-title"
                                    style="font-family: 'Lumanosimo', cursive;letter-spacing:1.5px"><span><i
                                            class="icon material-icons md-fastfood"></i></span> Deal Item

                                    <?php if (mysqli_num_rows($result) === 0) {
                                        
                                    } else {
                                        ?>


                                    <a href="#" style="margin-left:150px" class="btn btn-success"
                                        onclick="redirectToUpdatePage(<?php echo $_SESSION['id']; ?>)"><i
                                            class="material-icons md-Edit"></i> </a>
                                </h5>
                                <?php } ?>

                                
                                <hr>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) === 0) {
                                        echo "no items added ";
                                    } else {


                                        while ($rows = mysqli_fetch_array($result)) { ?>


                                    <ul class="list"
                                        style="font-family: 'Ysabeau Infant', sans-serif;letter-spacing:1px;">


                                        <li style="text-transform:uppercase"><?php echo $rows["item_name"] ?> x
                                            <?php echo $rows["quantity"] ?>=
                                            <?php echo $rows["total_amount"] ?> Rs <form action="copy copy.php"
                                                method="post">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger"
                                                    value="<?php echo $rows['id']; ?>"><i
                                                        class="material-icons md-Delete"></i></button>
                                            </form>
                                    </ul>















                                    <?php } ?>



                                    <?php } ?>
                                </tbody>

                            </table>











                        </div>
                        <div class="col-md-8">
                            <form action="copy copy.php" method="post">
                                <table class="table" id="data-table">
                                    <thead>
                                        <tr>

                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>



                                        <tr>
                                            <td><select name="item[]" class="form-control" style="width: max-content;"
                                                    onchange="getPriceAndSetTotal(this)">
                                                    <?php echo getItemOptions(); ?>
                                                </select></td>
                                            <td> <input type="text" class="form-control" name="price[]" readonly></td>
                                            <td><input type="number" class="form-control" name="quantity[]" min="1"
                                                    value="1" onchange="updateTotalAmount(this)"></td>
                                            <td><input type="text" class="form-control" name="total_amount[]" readonly>
                                            </td>
                                            <td class="text-end">

                                                <button type="button"
                                                    style="background-color: green;color:white;border:1px solid white;font-size:15px"
                                                    class="copy-row">+</button>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    style="background-color: red;color:white;border:1px solid white;font-size:15px"
                                                    class="remove-row">-</button>
                                            </td>

                                        </tr>
                                    </tbody>
                                    <tr>

                                        <td>
                                            <button class="btn btn-outline-success" type="submit" class=""
                                                name="submit">Submit</button>
                                        </td>
                                    </tr>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Function to copy row data
        $(document).on('click', '.copy-row', function() {
            var $row = $(this).closest('tr');
            var $newRow = $row.clone();
            $row.after($newRow);
        });

        // Function to remove row
        $(document).on('click', '.remove-row', function() {
            var $row = $(this).closest('tr');
            if ($('#data-table tr').length > 2) {
                $row.remove();
            } else {
                $row.find('input[type="text"]').val('');
            }
        });

        // Function to add a new row
        $('#add-new-row').on('click', function() {
            var $table = $('#data-table');
            var $lastRow = $table.find('tr:last');
            var $newRow = $lastRow.clone();
            $newRow.find('input[type="text"]').val('');
            $table.append($newRow);
        });
    });

    function getPriceAndSetTotal(select) {
        var itemId = $(select).val(); // Get the selected item's value
        var $row = $(select).closest('tr');
        var $priceInput = $row.find('input[name="price[]"]');
        var $quantityInput = $row.find('input[name="quantity[]"]');
        var $totalAmountInput = $row.find('input[name="total_amount[]"]');
        $.ajax({
            type: "POST",
            url: "price.php",
            data: {
                item_id: itemId
            }, // Include the selected item's value in the AJAX request
            dataType: "json",
            success: function(responseData) {
                // Handle the response data
                $priceInput.val(responseData.price);
                updateTotalAmount($quantityInput[0]); // Trigger total amount calculation
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the exact response received
                alert("An error occurred while processing the response. Please try again later.");
            }
        });
    }

    function redirectToUpdatePage(dealId) {
        // Redirect to the update page with the selected deal_id
        window.location.href = "update.php?deal_id=" + dealId;
    }




    function updateTotalAmount(input) {
        var $row = $(input).closest('tr');
        var price = parseFloat($row.find('input[name="price[]"]').val());
        var quantity = parseInt($(input).val());
        var totalAmount = isNaN(price) || isNaN(quantity) ? 0 : price * quantity;
        $row.find('input[name="total_amount[]"]').val(totalAmount);
    }
    </script>
    <script>
    if (localStorage.getItem("darkmode")) {
        var body_el = document.body;
        body_el.className += 'dark';
    }
    </script>

    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/scriptc619.js?v=1.0"></script>

</body>

<!-- Mirrored from www.ecommerce-admin.com/demo/page-categories.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:01 GMT -->

</html>