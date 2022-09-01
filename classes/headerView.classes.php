<?php

class Header {

	private $page;
	private $position;
	private $user;

	public function __construct($position, $user, $page) {
		$this->page = $page;
		$this->position = $position;
		$this->user = $user;
	}

	private function getItems() {
		if ($this->position == "v1") {
			$items = array("Мои рейсы" => "driver.php");
			return $items;
		} elseif ($this->position == "v2") {
			$items = array("Автобусы" => "mechanic.php", 
				           "Техосмотр" => "maintenance.php",
				           "Мойка" => "washing.php");
			return $items;
		} elseif ($this->position == "v3") {
			$items = array("Мои рейсы" => "disp.php", 
				           "Все рейсы" => "flights.php",
				           "Маршруты" => "routes.php",
				           "Остановки" => "stops.php",
				           "Проездные" => "tickets.php");
			return $items;
		} elseif ($this->position == "v4") {
			$items = array("Персонал" => "administrator.php");
			return $items;
		}
	}

	private function gecCurrentpage($items) {
		foreach ($items as $item => $link) {
			if ($this->page == ("/pages/" . $link)) {
				return $item;
			}
		}
		return false;
	}

	public function renderHeader() {
		$items = $this->getItems();
		$pageTitle = $this->gecCurrentpage($items);
		?>

		<header>
			<div class="mobileTitile">
				<div class="menuIcon"></div>
				<p><?= $pageTitle ?></p>
			</div>
			<div class="header">
				<div class="header_text_left">
					<h2 class="logo">Автобусный парк</h2>
					<?php 
					
					foreach ($items as $item => $link) {
						?>
						<div class="menu2 <?php if ($item === $pageTitle) { echo "selected"; } ?>">
							<a class="menu" href="<?= $link ?>"><?= $item ?></a>
						</div>
						<?php
					}
					?>
				</div>
				<div class="header_text_right">
      				<a class="menu2 userName" href="../profile.php">
      					<?= $this->user ?>
      				</a>
      				<form class="logout menu2" action="../inc/logout.php" method="post">
        				<button class="logoutIcon" type="submit"></button>
      				</form>
    			</div>
    		</div>
  		</header>
  		<?php
	}
}