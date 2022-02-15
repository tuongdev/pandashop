    <div class="form-group col-sm-4">
        <select name="province" class="form-control province" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Tỉnh / thành phố')" oninput="this.setCustomValidity('')">
            <option value="">Tỉnh / thành phố</option>
            <?php 
            foreach ($provinces as $province) {
                ?>
                <option <?=$customer_province_id==$province->getId() ? "selected" : ""?> value="<?=$province->getId()?>"><?=$province->getName()?></option>
                <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="district" class="form-control district" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Quận / huyện')" oninput="this.setCustomValidity('')">
            <option value="">Quận / huyện</option>
            <?php 
            foreach ($districts as $district) {
                ?>
                <option <?=$customer_district_id==$district->getId() ? "selected" : ""?> value="<?=$customer_district_id?>"><?=$district->getName()?></option>
                <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="ward" class="form-control ward" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Phường / xã')" oninput="this.setCustomValidity('')">
            <option value="">Phường / xã</option>
            <?php 
            foreach ($wards as $ward) {
                ?>
                <option <?=$customer_ward_id==$ward->getId() ? "selected" : ""?> value="<?=$ward->getId()?>"><?=$ward->getName()?></option>
                <?php 
            }
            ?>
            
        </select>
    </div>
    