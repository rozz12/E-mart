<?php
    session_start();
    include('php/connection.php');
    if (!isset($_POST['add_button'])) {
        //header('Location:TraderUI.php');
    }
    else{
        $errors = '';
         $shop_name = filter_var(trim($_POST['shopName']),FILTER_SANITIZE_STRING);
        $est_date = $_POST['estDate'];
        $shop_type = $_POST['shopType'];

        if(empty($shop_name))
        {
            $errors = "Shop name can not be empty";
        }

        if(gettype($shop_name)!='string')
        {
            $errors = "Shop name must be alphabetical";
        }

        if(empty($est_date))
        {
            $errors = "Established date can not be empty";
        }

        if(empty($shop_type))
        {
            $errors = "Shop type can not be empty";
        }

        //counting the number of errors
       /* if (count($errors)>=1) {
            $errors = 'Please review your Add Shop form submission again. Multiple errors found.';
                header('Location: TraderUI.php?errors='.$errors);
        }*/
        else{
            //check if shop already exists
            $chk_qry = "SELECT Shop_name FROM Shop WHERE Shop_name = :shop_name";
            $chk_parse = oci_parse($conn, $chk_qry);
            oci_bind_by_name($chk_parse, ':shop_name', $shop_name);
            oci_execute($chk_parse);
            oci_fetch_assoc($chk_parse);
            if (oci_num_rows($chk_parse)!=0) {
                echo "<script>

                            alert('Shop already exists.');
                            window.location.href = 'TraderUI.php';
                    </script>";
            }
            else{
                $qry = "SELECT shoptype_id FROM Shop_type WHERE shop_type = '".$shop_type."'";
                $prs=oci_parse($conn, $qry);
                oci_execute($prs);
                $row = oci_fetch_assoc($prs);

                $insert = "INSERT INTO SHOP (Shop_name,established_date,Trader_id,Shoptype_id) VALUES(:shop_name,:estd_date,:Trader_id,:sid)";
                $ins_prs = oci_parse($conn, $insert);
                oci_bind_by_name($ins_prs, ':shop_name', $shop_name);
                oci_bind_by_name($ins_prs, ':estd_date', $est_date);
                oci_bind_by_name($ins_prs, ':Trader_id', $_SESSION['Trader_id']);
                oci_bind_by_name($ins_prs, ':sid', $row['SHOPTYPE_ID']);
                oci_execute($ins_prs);
                oci_free_statement($ins_prs);
                
                $errors = 'Shop Added Sucesfully.';
                header('Location: TraderUI.php?errors='.$errors);

            }
        }   
    }
   

?>

