# Ilumno Modulo Programas
Este modulo esta diseñado como proposito de prueba tecnica para Ilumno

Se puede clonar e instalar en un drupal limpio, si se desea manejar por independiente.

- Se deben declarar tres rutas en el sistema /ilumno-module/form, /ilumno-module/data y /ilumno-module/register
  - **OK, declaradas en el archivo ilumno_programs.routing.yml**

- En la ruta /ilumno-module/form se debe mostrar un formulario que tenga los siguientes campos y características:
  - Nombre Programa: Campo de texto. Este campo es requerido y solo acepta caracteres alfanuméricos
  - Identificador: Campo de texto. Este campo es requerido y solo acepta caracteres alfanuméricos
  - Código: Campo de texto. Este campo es requerido y solo acepta números.
  - Fecha: Campo de fecha. Puede usar el formato que mejor considere, pero debe dar un texto de ayuda al usuario.
  - Tipo: Campo de selección, las opciones son Pregrado, Posgrado, Curso Corto.
    - **OK, se puede visualizar en la ruta http://localhost:81/app/web/ilumno-module/form** 

- Al momento de la instalación el módulo se deben crear dos tablas que se llamen “programs” y “user_register” para la tabla “programs" debe tener los campos que se mencionaron en el punto anterior más un campo llamado “State”. Para la tabla “user_register” es necesario tener los campos:
  - Nombre
  - Programa
  - Comentario
  - Fecha
    - **OK, se crean las dos tablas al momento de instalar los modulos** 

- Validar obligatoriedad, formatos de los campos utilizando las funciones apropiadas 
  - **OK, se valida cada campo por individual a traves de Ajax, y al final se validan al enviar el formulario completo** 
- Al realizar el envío del formulario, llenar los datos en la tabla mencionada en el paso anterior. Colocar el campo “State” en 1 si el tipo es “Pregrado” o 2 para el resto de los valores. Adicionalmente mostrar un mensaje en pantalla al finalizar el envío del formulario.
  - **OK, se almacena en la tabla indicada y se muestra el mensaje solicitado**
- En la ruta /ilumno-module/register, se debe disponibilizar un servicio que reciba los valores de la tabla “user_register” y los inserte en dicha tabla
  - **OK, se almacenan los datos en la tabla indicada**
