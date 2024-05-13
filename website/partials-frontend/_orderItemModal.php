<?php 
    $itemModalSql = "SELECT * FROM `tbl_orders` WHERE `userId`= $userId";
    $itemModalResult = mysqli_query($conn, $itemModalSql);

    if (!$itemModalResult) {
        // Handle query execution error
        echo "Error executing query: " . mysqli_error($conn);
       // print te error

    } else {
        while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
            $orderid = $itemModalRow['orderId'];
    ?>

<!-- Modal -->
<div class="modal fade" id="orderItem<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php echo $orderid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderItem<?php echo $orderid; ?>">Order Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="container">
                    <div class="row">
                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table text">
                            <thead>
                                <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="px-3">Item</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="text-center">Quantity</div>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $mysql = "SELECT * FROM `orderitems` WHERE orderId = $orderid";
                                    $myresult = mysqli_query($conn, $mysql);
                                    while($myrow = mysqli_fetch_assoc($myresult)){
                                        $itemId = $myrow['itemId'];
                                        $itemQuantity = $myrow['itemQuantity'];
                                        
                                        $itemsql = "SELECT * FROM `tbl_item` WHERE itemId = $itemId";
                                        $itemsresult = mysqli_query($conn, $itemsql);
                                        
                                        $itemrow = mysqli_fetch_assoc($itemsresult);
                                        $id =$itemrow['itemId'];
                                        $title = $itemrow['title'];
                                        $price = $itemrow['price'];
                                        $Desc = $itemrow['description'];
                                        $category_id = $itemrow['category_id'];
                                        $image = $itemrow['image_name'];
                                        echo '<tr>
                                        <th scope="row">
                                            <div class="p-2">';
                                if ($image != "") {
                                    // Use SITEURL for consistency
                                    echo "<img src='" . SITEURL . "images/item/" . htmlspecialchars($image) .  "' width='100px'>";

                                } else {
                                    echo "<div class='text-danger'>Image not added</div>";
                                }
                                echo '<div class="ml-3 d-inline-block align-middle">
                                <h5 class="mb-0"><a href="viewitem.php?itemId=<?php echo $id;?>" class="text-dark d-inline-block align-middle"> '.$title.'</a></h5>
                                <span class="text-muted font-weight-normal font-italic d-block">Rs. ' . $price . '/-</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle text-center"><strong>' . $itemQuantity . '</strong></td>
                                </tr>';
                                
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    }
}
?>