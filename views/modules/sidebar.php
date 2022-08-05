<aside class="main-sidebar" >

	<section class="sidebar">

		<ul class="sidebar-menu">

			<li class="active">

				<a href="home">

					<i class="fa fa-home"></i>

					<span style="font-family: NRT;">سەرەکی</span>

				</a>

			</li>
		<?php	if($_SESSION["profile"] == "administrator") 
			echo '
			<li>

				<a href="users">

					<i class="fa fa-user"></i>

					<span style="font-family: NRT;">بەکارهێنەرەکان</span>

				</a>

			</li>';
            ?>
			<li>

				<a href="categories">

					<i class="fa fa-th"></i>

					<span style="font-family: NRT;">بابەتەکان</span>

				</a>

			</li>
			<li>
			
				<a href="products">

					<i class="fab fa-product-hunt"></i>

					<span style="font-family: NRT;">کاڵاکان</span>

				</a>

			</li>
			<li>

				<a href="customers">

					<i class="fa fa-users"></i>

					<span style="font-family: NRT;">کڕیارەکان</span>

				</a>

			</li>

			<li>

				<a href="soldout">

				<i class="fas fa-sort-amount-down"></i>

					<span style="font-family: NRT;">تەواوبووەکان</span>

				</a>

			</li>

			<li>

				<a href="qarz">

				<i class="fad fa-money-bill-alt"></i>

					<span style="font-family: NRT;"> قەرزەکان </span>

				</a>

			</li>

			<li>

						<a href="manage-sales">

						<i class="fad fa-envelope-open-dollar"></i>

							<span style="font-family: NRT;">فرۆشراوەکان</span>

						</a>

			</li>

			<li>

						<a href="create-sales">

							<i class="fa fa-shopping-basket"></i>

							<span style="font-family: NRT;">فرۆشتن</span>

						</a>

			</li>
			<?php	if($_SESSION["profile"] == "administrator") {
			echo '
			<li>

						<a href="sales-report">

						<i class="fas fa-analytics"></i>

							<span style="font-family: NRT;">راپۆرتی فرۆشتن</span>

						</a>

			</li>';
		}
			?>

			<!-- <li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>

					<span>Sales</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="manage-sales">

							<i class="fa fa-circle"></i>

							<span>Manage sales</span>

						</a>

					</li>

					<li>

						<a href="create-sales">

							<i class="fa fa-circle"></i>

							<span>Create sale</span>

						</a>

					</li>

					<li>

						<a href="sales-report">

							<i class="fa fa-circle"></i>

							<span>Sales report</span>

						</a>

					</li>



				</ul>

			</li> -->
			<li>

				<a href="backup">

				<i class="fad fa-database"></i>

					<span style="font-family: NRT;"> هەڵگرتنی داتا</span>

				</a>

			</li>
			<li>

				<a href="logout">

					<i class="fa fa-sign-out"></i>

					<span style="font-family: NRT;">چوونە دەر</span>

				</a>

			</li>

		</ul>

	</section>

</aside>