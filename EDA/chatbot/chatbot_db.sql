import sqlite3
from flask import Flask, render_template, request, jsonify

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

def generate_activity(style):
    # Tu función para generar actividades aleatorias

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/get_activity", methods=["POST"])
def get_activity():
    data = request.get_json()
    user_id = data.get("user_id")
    style = data["style"]
    activity = generate_activity(style)
    
    # Almacenar la actividad en la base de datos
    conn = sqlite3.connect('chatbot_db.sqlite')
    cursor = conn.cursor()
    cursor.execute("INSERT INTO user_activities (user_id, style, activity) VALUES (?, ?, ?)", (user_id, style, activity))
    conn.commit()
    conn.close()
    
    return jsonify({"message": activity})

if __name__ == "__main__":
    app.run(debug=True)
