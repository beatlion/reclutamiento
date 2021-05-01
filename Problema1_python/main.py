from tkinter import Tk, Label, Button
from methods.procesar_archivo import procesar_archivo


def btn_click():
    response = procesar_archivo()
    message = response["message"]
    colorLetras = "green" if response["status"] else "red"

    lbl = Label(ventana)
    lbl["text"] = message
    lbl["fg"] = colorLetras
    lbl.pack()


ventana = Tk()
ventana.geometry("450x300")
ventana.title("Hola mundo")


btn = Button(
    ventana,
    text="Presiona este para procesar el archivo y generar las respuestas",
    command=btn_click,
)
btn.pack()


ventana.mainloop()
