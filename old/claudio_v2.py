import mysql.connector

while True:
    # Configuración de conexión a la base de datos
    config = {
      'user': 'root',
      'password': '12345678',
      'host': 'localhost',
      'database': 'FSC'
    }

    # Conexión a la base de datos
    try:
        conn = mysql.connector.connect(**config)
        print("Conexión a la base de datos establecida correctamente")
    except mysql.connector.Error as e:
        print(f"Error de conexión a la base de datos: {e}")

    # Obtener valores del formulario
    peso = input("Ingrese el peso: ")
    tiempo = str(int(time.time())) # Obtener el tiempo actual en formato unixtime

    # Insertar datos en la base de datos
    cursor = conn.cursor()
    sql = f"INSERT INTO tabla_peso (peso, tiempo) VALUES ('{peso}', '{tiempo}')"
    try:
        cursor.execute(sql)
        conn.commit()
        print("Los datos han sido ingresados correctamente en la base de datos")
    except mysql.connector.Error as e:
        conn.rollback()
        print(f"Error al ingresar datos: {e}")

    # Cerrar conexión a la base de datos
    cursor.close()
    conn.close()

    # Esperar la entrada del usuario
    input("Presione cualquier tecla para reiniciar el programa...")
