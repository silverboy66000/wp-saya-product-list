<?php
global $wpdb;

$http = _wp_http_get_object();
$siteUrl = get_option( 'siteurl' );

//---- start get last token form DB
do_action('crmAccessToken');
$table_name_token = $wpdb->prefix . 'noyan_crm_settings';
$sqlToken = "SELECT * FROM  $table_name_token LIMIT 1";
$resultsToken = $wpdb->get_results($sqlToken);
$accessToken = $resultsToken[0]->access_token;
//----- end get last token form DB

?>

    <div class="wrap">
        <div id="icon-users" class="icon32"></div>
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php
		if($_FILES){
			$data=file($_FILES['file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

			echo '<table class="wp-list-table widefat fixed striped table-view-list toplevel_page_vehicles_list_logs_menu"><thead>';
			foreach ($data as $key=>$dataDetails)
			{
				$updateStatus=null;
				$statusString=explode(',',$dataDetails)[2];
				$id=explode(',',$dataDetails)[0];
				$price=explode(',',$dataDetails)[3];
                if ($key>0)
				{
					if (explode(',',$dataDetails)[2]==1)
					{
						$status='instock';
						$statusString='موجود';
					}
					else
					{
						$status='outofstock';
						$statusString='ناموجود';

					}
					$product = wc_get_product( $id );

					if ($product)
					{
						update_post_meta($id, '_price', (float)$price);
						update_post_meta($id, '_regular_price', (float)$price);
						$product->set_stock_status($status);
						$product->save();
						$updateStatus='محصول آپدیت شد';
					}
					else
					{
						$updateStatus='محصول یافت نشد';
					}
				}
				echo '<tr>';
				echo '<td>'.$key++.'</td>';
				echo '<td>'.explode(',',$dataDetails)[1].'</td>';
				echo '<td>'.$statusString.'</td>';
				echo '<td>'.$price.'</td>';
				echo '<td>'.$updateStatus.'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		else
		{
			?>
            <p>برای آپدیت سریع قیمت ها و وضعیت موجود بودن محصول در انبار شرکت میتوانید طبق الگوی استاندارد ووکامرس محصولات اپدیت شده را از طریق این فرم آپلود و اپدیت را با سرعت انجام دهید
            </p>
            <p>
                برای دریافت لیست محصولات میتوانید از برون ریز ووکامرس استفاده نمایید
            </p>
            <p>
                فراخوانی این فرم نامحدود است و هر تعداد بار میتوانید فراخوانی کنید
            </p>
            <form method="post" enctype="multipart/form-data">
                <input required="required" type="file" name="file" />
                <button>upload</button>
            </form>
			<?php
		}
		?>
    </div>

<?php


?>