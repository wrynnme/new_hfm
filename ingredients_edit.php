<?php require_once 'includes/class-autoload.inc.php'; ?>
<?php require_once 'includes/check_unlogin.inc.php'; ?>
<?php checkAdmin(); ?>
<?php
(isset($_GET['id']))?$id = $_GET['id']:header('Location:ingredients_list.php');

$ings = new ingredientsview();
$ing = $ings->id($id);
$ingT = $ings->idType($ing['ing_type']);
$type = $ings->type();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php require_once 'includes/head.inc.php'; ?>
</head>
<body data-id="<?php echo $id;?>" data-pic="<?php echo $ing['ing_img'];?>">
	<?php require_once 'includes/nav_defalut.inc.php'; ?>
	<div class="container mb-5">
		<div class="text-center">
			<div class="h1">แก้ไขวัตถุดิบ</div>
			<div class="h2 mb-5">Edit ingredients</div>
		</div>
		<form class="needs-validation" novalidate action="#" method="post" enctype="multipart/form-data" id="myForm">
			<div class="form-row">
				<div class="col-md mb-3">
					<label for="ing_name">ชื่อวัตถุดิบ</label>
					<input type="text" class="form-control" id="ing_name" name="ing_name" value="<?php echo $ing['ing_name'];?>" required>
					<div class="invalid-feedback">
						กรุณากรอก ชื่อวัตถุดิบ
					</div>
				</div>
				<div class="col-md mb-3">
					<label for="ing_kcal">แคลอรี่ : 100 กรัม</label>
					<input type="number" class="form-control" id="ing_kcal" name="ing_kcal" value="<?php echo $ing['ing_kcal'];?>" required>
					<div class="invalid-feedback">
						กรุณากรอก แคลอรี่ ต่อ 100 กรัม
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md mb-3">
					<label for="ing_img">รูปของวัตถุดิบ</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="ing_img" name="ing_img" accept="image/*">
						<label class="custom-file-label" for="ing_img"><?php echo $ing['ing_img'];?></label>
						<div class="invalid-feedback">กรุณา ใส่รูปวัตถุดิบ</div>
					</div>
					<small id="ing_img" class="form-text text-muted">ขนาด 260 x 260 pixel</small>
				</div>
				<div class="col-md-4 mb-3">
					<label for="ing_type">ประเภทของวัตถุดิบ</label>
					<select class="custom-select" id="ing_type" name="ing_type" required>
						<option selected value="<?php echo $ing['ing_type'];?>"><?php echo $ingT['ingt_name'];?></option>
						<option disabled value="">เลือก...</option>
						<?php for ($i = 0; $i < sizeof($type); $i++) { ?>
							<option value="<?php echo $type[$i]['ingt_id'];?>"><?php echo $type[$i]['ingt_name'];?></option>
						<?php } ?>
					</select>
					<div class="invalid-feedback">
						กรุณาเลือก ประเภทของวัตถุดิบ
					</div>
				</div>
				<div class="col-md mb-3">
					<label for="ing_type">สถานะของวัตถุดิบ</label>
					<br>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-secondary <?php echo (($ing['ing_status'] == '0')? 'active' :NULL);?>">
							<input type="radio" name="ing_status" id="0" value="0" <?php echo (($ing['ing_status'] == '0')? 'checked' :NULL);?>> ปิดการใช้งาน
						</label>
						<label class="btn btn-secondary <?php echo (($ing['ing_status'] == '1')? 'active' :NULL);?>">
							<input type="radio" name="ing_status" id="1" value="1" <?php echo (($ing['ing_status'] == '1')? 'checked' :NULL);?>> รอการยืนยัน
						</label>
						<label class="btn btn-secondary <?php echo (($ing['ing_status'] == '2')? 'active' :NULL);?>">
							<input type="radio" name="ing_status" id="2" value="2" <?php echo (($ing['ing_status'] == '2')? 'checked' :NULL);?>> เปิดการใช้งาน
						</label>
					</div>
					<div class="invalid-feedback">
						กรุณาเลือก ประเภทของวัตถุดิบ
					</div>
				</div>
			</div>
			<div class="row mx-auto text-center">
				<div class="col">
					<label for="picfood" class="figure">
						<img src="dist/img/ingredients/<?php echo $ing['ing_img']; ?>" class="rounded img-thumbnail img-fluid" width="480px" height="480px">
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md">
					<button class="btn btn-success btn-block" type="submit" name="submit">แก้ไขวัตถุดิบ</button>
				</div>
				<div class="col-md">
					<button class="btn btn-outline-danger btn-block" type="reset">ยกเลิก</button>
				</div>
			</div>
		</form>
	</div>
	<script src="dist/js/be.js"></script>
	<script src="dist/js/ingre_edit.js"></script>
</body>
</html>