<div class="contentContainer">
    <div class="contentContainerTitle">
        Nauja apklausa
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?=form_open('admin/poll/create');?>
        <input type="text" name="name" class="form-control inputSpacing" placeholder="Klausimas" required />
        <select id="answersCount" name="answersCount" class="form-control inputSpacing" required>
            <option value="" disabled selected>Atsakymų skaičius</option>
            <option value="2">Atsakymų skaičius: 2</option>
            <option value="3">Atsakymų skaičius: 3</option>
            <option value="4">Atsakymų skaičius: 4</option>
            <option value="5">Atsakymų skaičius: 5</option>
            <option value="6">Atsakymų skaičius: 6</option>
            <option value="7">Atsakymų skaičius: 7</option>
            <option value="8">Atsakymų skaičius: 8</option>
            <option value="9">Atsakymų skaičius: 9</option>
        </select>
        <div id="pollAnswers">
        
        </div>
        <input type="submit" class="btn btn-primary " value="Sukurti" />
        </form>
    </div>
</div>
<hr class="contentContainerHr">