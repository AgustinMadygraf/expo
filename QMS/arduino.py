import serial
import time
import requests

# Configura el puerto serie (USB)
ser = serial.Serial('COM4', 9600)  # Reemplaza 'COMX' con el puerto serie correspondiente en tu sistema

while True:
    if ser.in_waiting > 0:
        # Lee los datos recibidos desde Arduino
        data = ser.readline().decode('utf-8').strip()
        
        # Verifica si los datos corresponden al peso
        if data.startswith("Peso:"):
            peso_str = data.split(":")[1].strip()  # Extrae la parte numérica del peso
            try:
                span = 1
                zero = 307000
                peso = float(peso_str)
                peso = (peso - zero) * span

                print("Peso recibido:", peso)
                
                # Obtiene el tiempo actual en formato Unix
                tiempo = int(time.time())
                
                # Construye la URL con el peso y el tiempo como parámetros
                url = f"http://localhost/expo/peso/procesar.php?peso={peso}&tiempo={tiempo}"
                
                # Realiza la solicitud HTTP a la URL
                response = requests.get(url)
                
                if response.status_code == 200:
                    print("Peso y tiempo enviados correctamente")
                else:
                    print("Error al enviar el peso y tiempo")
                
            except ValueError:
                print("Error al convertir el peso a número:", peso_str)
    
    time.sleep(1)  # Espera 5 segundos antes de la próxima lectura
