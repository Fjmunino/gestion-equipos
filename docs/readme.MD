<h1>Indicaciones deploy</h1>

<p>
    Se adjuntan dos ficheros SQL para importar la base de datos:
</p>
<ul>
    <li><strong>bd_gestion_equipos.sql</strong>: importa solo las tablas y los datos que haya en ellas</li>
    <li><strong>bd_gestion_equipos_including_table.sql</strong>: importa la base de datos al completo (incluida la creación de la misma)</li>
</ul>

<h2>
    Configuraciones
</h2>

<p>
    He desarrollado la aplicación en un servidor local. Las urls de la aplicación se establecen en el archivo "config.php"
</p>
<p>
    Para la base de datos hay que cambiar (si fuese necesario) los parámetros de conexión en model/DB. Los parámetros por defecto son:
</p>
<ul>
    <li>Host: localhost</li>
    <li>dbname: gestion_equipos</li>
    <li>User: root</li>
    <li>Password: ""</li>
</ul>