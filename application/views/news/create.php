<h2>Create a news item</h2>

<?php echo validation_errors(); ?> <!-- muestra errores de validación -->

<?php echo form_open('news/create') ?> <!-- provee métodos de ayuda para los formularios -->

<label for="title">Title</label>
<input type="input" name="title" /><br />

<label for="text">Text</label>
<textarea name="text"></textarea><br />

<input type="submit" name="submit" value="Create news item" />

</form>