from flask import Flask, render_template, request, jsonify
import sqlite3
import random

app = Flask(__name)

# Crear una base de datos SQLite y una tabla para las actividades
conn = sqlite3.connect('chatbot_db.sqlite')
cursor = conn.cursor()
cursor.execute('''
    CREATE TABLE IF NOT EXISTS user_activities (
        user_id INTEGER,
        style TEXT,
        activity TEXT
    )
''')
conn.commit()
conn.close()

# Define actividades por estilo de aprendizaje
auditory_activities = [
    "Escucha una grabación de una lección sobre un tema.",
    "Participa en un proyecto grupal en el que tengas que explicar un concepto a otros estudiantes.",
    "Escucha música o sonidos que te ayuden a concentrarte."
]

visual_activities = [
    "Ver un video o una presentación sobre un tema.",
    "Leer un texto o un artículo sobre un tema.",
    "Crear un diagrama o un mapa mental de un concepto."
]

kinesthetic_activities = [
    "Construir un modelo físico de un concepto.",
    "Participar en un juego o actividad que implique movimiento.",
    "Experimentar con un concepto de forma práctica."
]

def generate_random_activity(style):
    if style == 'auditivo':
        activity = random.choice(auditory_activities)
    elif style == 'visual':
        activity = random.choice(visual_activities)
    elif style == 'kinestesico':
        activity = random.choice(kinesthetic_activities)
    else:
        activity = 'No entiendo tu estilo de aprendizaje.'

    return activity

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/get_activity", methods=["POST"])
def get_activity():
    data = request.get_json()
    user_id = data.get("user_id")
    style = data["style"]
    activity = generate_random_activity(style)

    # Almacenar la actividad en la base de datos
    conn = sqlite3.connect('chatbot_db.sqlite')
    cursor = conn.cursor()
    cursor.execute("INSERT INTO user_activities (user_id, style, activity) VALUES (?, ?, ?)", (user_id, style, activity))
    conn.commit()
    conn.close()

    return jsonify({"message": activity})

@app.route("/actividades")
def mostrar_actividades():
    conn = sqlite3.connect('chatbot_db.sqlite')
    cursor = conn.cursor()
    cursor.execute("SELECT activity FROM user_activities")
    actividades = cursor.fetchall()
    conn.close()

    # Convierte la lista de tuplas en una lista plana de actividades
    actividades = [actividad[0] for actividad in actividades]

    return render_template("actividades.html", actividades=actividades)

if __name__ == "__main__":
    app.run(debug=True)

