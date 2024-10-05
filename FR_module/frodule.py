import os
import sys
import cv2
import dlib
import face_recognition
import numpy as np


DATASET_FOLDER = '../public/storage/Photos/SuspectFace'
# Load pre-trained Haar Cascade classifier for gender detection
gender_classifier = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

shape_predictor_path = "C:/xampp 8.2/htdocs/Smart_Cop/FR_module/req_files/shape_predictor_68_face_landmarks.dat"
landmark_predictor = dlib.shape_predictor(shape_predictor_path)

def align_face(image, face_location):
    """Aligns face based on landmarks to improve face recognition accuracy."""
    face_landmarks = face_recognition.face_landmarks(image, [face_location])
    if len(face_landmarks) > 0:
        left_eye = np.mean(face_landmarks[0]['left_eye'], axis=0)
        right_eye = np.mean(face_landmarks[0]['right_eye'], axis=0)
        dy = right_eye[1] - left_eye[1]
        dx = right_eye[0] - left_eye[0]
        angle = np.degrees(np.arctan2(dy, dx))
        center = np.mean([left_eye, right_eye], axis=0).astype(int)
        center = (float(center[0]), float(center[1]))
        M = cv2.getRotationMatrix2D(center, angle, scale=1.0)
        aligned_image = cv2.warpAffine(image, M, (image.shape[1], image.shape[0]), flags=cv2.INTER_CUBIC)
        return aligned_image
    return image

def load_images_from_folder(folder):
    images = []
    for filename in os.listdir(folder):
        img_path = os.path.join(folder, filename)
        img = face_recognition.load_image_file(img_path)
        face_locations = face_recognition.face_locations(img)
        if len(face_locations) > 0:
            aligned_img = align_face(img, face_locations[0])
            img_encoding = face_recognition.face_encodings(aligned_img, [face_locations[0]])[0]
            gray_img = cv2.cvtColor(aligned_img, cv2.COLOR_BGR2GRAY)
            faces = gender_classifier.detectMultiScale(gray_img, scaleFactor=1.1, minNeighbors=5)
            gender = "Male" if len(faces) > 0 and faces[0][2] > 100 else "Female"
            images.append((filename, img_encoding.tolist(), gender))  # Store encoding as list
    return images

def compare_faces(dataset_folder, target_image_path, tolerance=0.6):
    target_img = face_recognition.load_image_file(target_image_path)
    face_locations = face_recognition.face_locations(target_img)
    if len(face_locations) == 0:
        return None, None

    aligned_target_img = align_face(target_img, face_locations[0])
    target_encoding = face_recognition.face_encodings(aligned_target_img, [face_locations[0]])[0]

    dataset_images = load_images_from_folder(dataset_folder)

    best_match_filename = None
    best_match_distance = float('inf')
    best_match_gender = None

    for filename, dataset_encoding, dataset_gender in dataset_images:
        face_distances = face_recognition.face_distance([dataset_encoding], target_encoding)
        if face_distances[0] < best_match_distance and face_distances[0] < tolerance:
            best_match_distance = face_distances[0]
            best_match_filename = filename
            best_match_gender = dataset_gender

    return best_match_filename, best_match_gender

if __name__ == "__main__":

    target_image_path = sys.argv[1]
    #target_image_path = "Target/IMG_20190912_013308.jpg"

    best_match, gender = compare_faces(DATASET_FOLDER, target_image_path, tolerance=0.6)

    if best_match:
        print(best_match)
    else:
        print("No match found")
