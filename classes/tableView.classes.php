<?php 

class TableView {
	private $coloumnNames;
	private $primaryKey;
	private $actions;
	private $table;

	public function __construct($table, $coloumnNames, $primaryKey = null, $actions = array()) {
		$this->table = $table;
		$this->coloumnNames = $coloumnNames;
		$this->primaryKey = $primaryKey;
		$this->actions = $actions;
	}

	private function renderTableHeader() {
		echo "<tr>";
		foreach ($this->coloumnNames as $coloumnName) {
			echo "<th>" . $coloumnName . "</th>";
		}
		if (!empty($this->actions)) {
			echo "<th colspan=\"" . count($this->actions) . "\">" . "Действие</th>";
		}
		echo "</tr>";
	}

	private function renderTableBody() {
		foreach ($this->table as $rowNumber => $row) {
			echo "<tr>";
			foreach ($this->coloumnNames as $key => $coloumnName) {
				$tr = $this->table[$rowNumber][$key];
				echo "<td>" . $tr . "</td>";
			}
			if (!empty($this->actions)) {
				foreach ($this->actions as $linkAction => $action) {
					?>
					<td class="actionTd">
						<form action="<?= $linkAction ?>" method="post">
							<input type = "text" name = "id" value ="<?= $this->table[$rowNumber][$this->primaryKey] ?>" hidden>
							<button class="tableButton <?php if ($action === "удалить" || $action === "прервать" || $action === "отменить") echo " red"; ?>"><?= $action ?></button>
						</form>
					</td>
					<?php
				}
			}
			echo "</tr>";
		}
	}

	public function renderTable() {
		if (empty($this->table)) {
			echo "<p>Нет данных</p>";
		}
		else {
			echo "<table>";
			$this->renderTableHeader();
			$this->renderTableBody($this->table);
			echo "</table>";
		}
	}

}
