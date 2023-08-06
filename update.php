<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}


function getItemOptions()
{
    $sql = "SELECT id ,item_name FROM items";
    $result = query_exec($sql);

    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['item_name'] . '</option>';
    }

    return $options;
}

if (isset($_GET["deal_id"])) {
    $_SESSION['id'] = $_GET["deal_id"];
    $var_id = $_GET["deal_id"];
    $result = query_exec("SELECT items.item_name,deal_details.*,deal_details.deal_id as update_id FROM `deal_details` INNER JOIN items on deal_details.item_id=items.id 
    WHERE deal_id='$_SESSION[id]' and deal_details.DeletedOn is null");
}

if (isset($_POST['submit'])) {
    $item_values = $_POST['item'];
    $price_values = $_POST['price'];
    $quantity_values = $_POST['quantity'];
    $total_amount_values = $_POST['total_amount'];
    $id_values = $_POST['id']; // Get the IDs of the rows

    // Loop through the submitted form data
    for ($i = 0; $i < count($item_values); $i++) {
        $item_id = $item_values[$i];
        $price = $price_values[$i];
        $quantity = $quantity_values[$i];
        $total_amount = $total_amount_values[$i];
        $id = $id_values[$i]; // Get the ID of the current row

        // Perform the update only if the 'id' matches the current row's ID
        // UPDATE `deal_details` SET `item_id`='2', `quantity`='12', `price`='12', `total_amount`='12' WHERE `id`='56' AND `deal_id`='15';

        $query = "UPDATE `deal_details` SET `item_id`='$item_id', `quantity`='$quantity',
         `price`='$price', `total_amount`='$total_amount',`LastModifiedOn`=NOW(),`LastModifiedBy`='$_SESSION[login]' WHERE `id`='$id'";

        $result = query_exec($query);
        if (!$result) {
            echo "Error updating row with ID $id. Please try again.";
            exit; // Exit the script if there's an error with the update
        }
    }

    // All rows updated successfully, redirect to "deal.php"
    redirect("deal.php");
}

?>


<?php include("headerlinks.php") ?>

<body>

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

                        <div class="col-md-12">
                            <form action="update.php" method="post">
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
                                        <?php
                                        if (mysqli_num_rows($result) === 0) {
                                            echo "<tr><td colspan='4'>No items found for this deal.</td></tr>";
                                        } else {
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>


                                                <tr>
                                                    <td>
                                                        <select name="item[]" class="form-control" onchange="getPriceAndSetTotal(this)">
                                                            <!-- Display the selected item's name -->
                                                            <option value="<?php echo $rows['item_id']; ?>" selected><?php echo $rows["item_name"]; ?>
                                                            </option>
                                                            <?php
                                                            $itemOptions = getItemOptions($rows['item_id']);
                                                            echo $itemOptions;
                                                            ?>
                                                        </select>
                                                        <!-- <select name="item[]" class="form-control" style="width: max-content;"
                            onchange="getPriceAndSetTotal(this)">
                            <?php
                                                $itemOptions = getItemOptions($rows['item_id']);
                                                echo $itemOptions;
                            ?>
                        </select> -->
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="price[]" value="<?php echo $rows["price"]; ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="quantity[]" min="1" value="<?php echo $rows["quantity"]; ?>" onchange="updateTotalAmount(this)">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="total_amount[]" value="<?php echo $rows["total_amount"]; ?>" readonly>
                                                    </td>
                                                    <!-- Add a hidden input field for the 'id' of the row -->
                                                    <input type="hidden" name="id[]" value="<?php echo $rows['id']; ?>">

                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tr>

                                        <td >
                                            <button class="btn btn-outline-success" type="submit" style="letter-spacing: 1.5px" name="submit">UPDATE RECORD</button>
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
            var itemId = $(select).val();
            var $row = $(select).closest('tr');
            var $priceInput = $row.find('input[name="price[]"]');
            var $quantityInput = $row.find('input[name="quantity[]"]');
            var $totalAmountInput = $row.find('input[name="total_amount[]"]');

            $.ajax({
                type: "POST",
                url: "get_item_price.php", // Replace with the actual path to your get_item_price.php file
                data: {
                    item_id: itemId
                },
                dataType: "json",
                success: function(responseData) {
                    if (responseData.success) {
                        $priceInput.val(responseData.price);
                        updateTotalAmount($quantityInput[0]);
                    } else {
                        console.error(responseData.error);
                        alert("Failed to fetch item price. Please try again later.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while processing the request. Please try again later.");
                }
            });
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