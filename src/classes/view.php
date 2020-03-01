<?php
class View
{

    public function render()
    {
        //TODO print all of the page!
    }

    public function printItems($items)
    {
        require_once "../src/template/head.php";
        require_once "../src/template/header.php";
        echo "<h1>Tennis item collection</h1><hr>";
        // echo "<hr>Printing items</br>";
        // foreach ($songs as $item) {
        //     echo "<br>";
        //     print_r($item);
        // }
        include "../src/template/add_item_form.php";
        echo "<hr>";
        if (isset($_GET['itemname'])) {
            $filterValue = $_GET['itemname'];
        } else {
            $filterValue = "";
        }
        include "../src/template/item_filter_form.php";
        echo "<hr>";
        $areColumnsSet = false;

        foreach ($items as $index => $row) {
            if (!$areColumnsSet) {
                echo "<div class='item-header-cont'>";
                foreach ($row as $colname => $cell) {
                    echo "<span class='col-fields'>$colname</span>";
                }
                echo "</div>";
                $areColumnsSet = true;
            }

            echo "<div class='item-cont'>";
            // echo "Row: $index";
            // print_r($row);
            echo "Song No: $index";
            echo "<form action='index.php' method='post'>";
            $rowid = $row['id'];
            echo "<input type='hidden' name='delForm' value='$rowid'>";
            echo "<button type='submit' class='del-Btn' name='delBtn' value='$rowid' id='del-$rowid'>Delete</button>";
            echo "</form>";
            echo "<form action='index.php' method='post'>";
            echo "<button type='submit' name='updateBtn' value='$rowid'>Update</button>";
            foreach ($row as $colname => $cell) {
                switch ($colname) {
                    case "id":
                        //do not show ids
                        break;
                    case "name":
                        echo "<input class='item-cell' type='text' name='name' value='$cell'></input>";
                        break;
                    case "firm":
                        echo "<input class='item-cell' type='text' name='firm' value='$cell'></input>";
                        break;
                    case "img_loc":
                        if ($cell) {
                            echo "<img src='$cell' alt='cool pic' width='100' heigth='100'>";
                        } else {
                            echo "<span>No Pic!</span>";
                        }
                        break;
                    default:
                        echo "<span class='item-cell'>$cell</span>";
                        break;
                }
                //we wrote the below if as switch above
                // if ($colname == "name") {
                //     echo "<input type='text' name='name' value='$cell'></input>";
                // } else {
                //     echo "<span class='track-cell'>$cell</span>";
                // }

            }
            echo "</form>";
            echo "</div>";
        }
        require_once "../src/template/footer.php";
    }

    public function printRegister()
    {
        require_once "../src/template/head.php";
        require_once "../src/template/header.php";
        require_once "../src/template/register_inputs.php";
        require_once "../src/template/footer.php";

    }

}
