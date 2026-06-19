from deepface import DeepFace
import os
import json
import argparse
from deepface.basemodels import VGGFace
import pandas as pd

backends = [
    'opencv', 
    'ssd', 
    'dlib', 
    'mtcnn', 
    'fastmtcnn',
    'retinaface', 
    'mediapipe',
    'yolov8',
    'yunet',
    'centerface',
]

def main():
    # Crear un objeto ArgumentParser
    parser = argparse.ArgumentParser(description='El script busca una imagen correspondiente a un alumno en la base de datos.')
    # Añadir argumentos
    parser.add_argument('--id', type=str, required=True, help='Id del usuario registrado para tomar asistencias.')

    # Parsear los argumentos
    args = parser.parse_args()

    # Construir la ruta del archivo
    img_path = f'/var/www/html/escuela_de_manejo/storage/app/public/faces/{args.id}.png'

    # Verificar la existencia del archivo
    if not os.path.exists(img_path):
        raise ValueError(f"Confirm that {img_path} exists")

    # Si el archivo existe, continuar con el procesamiento
    print(f'El archivo {img_path} existe.')

    # Realizar la búsqueda con DeepFace
    result = DeepFace.find(
        img_path=img_path,
        db_path="/var/www/html/escuela_de_manejo/deepface/database",
        model_name="VGG-Face",
        detector_backend=backends[0],  # Puedes ajustar el backend según sea necesario
    )

    # Obtener el path de la imagen encontrada
    found_image_path = result[0]['identity'][0]

    # Extraer solo el ID del alumno curso
    filename = os.path.basename(found_image_path)  # Obtener el nombre del archivo (id.png)
    alumno_curso_id = os.path.splitext(filename)[0]  # Eliminar la extensión y obtener solo el ID

    # Imprimir el ID
    print(alumno_curso_id)

    # También puedes retornar el resultado en formato JSON si lo necesitas
    output = {
        "alumno_curso_id": alumno_curso_id
    }
    print(json.dumps(output))

if __name__ == '__main__':
    main()