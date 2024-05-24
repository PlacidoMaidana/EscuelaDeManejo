

from deepface import DeepFace

#obj = DeepFace.analyze(img_path="path_to_your_image.jpg", actions=['age', 'gender', 'race', 'emotion'])
#print(obj)
#result = DeepFace.stream("C:\\xampp\\htdocs\\deepface\\database", model_name = "VGG-Face")
DeepFace.stream(db_path = "C:/xampp/htdocs/deepface/database")