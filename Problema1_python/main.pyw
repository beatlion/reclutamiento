from tkinter import Tk, filedialog, Button, messagebox
import sys

sys.path.append("./app/")
from Processor import Processor


# from methods.procesar_archivo import procesar_archivo


def callback():
    rutaArchivo = filedialog.askopenfilename()
    if rutaArchivo != "":
        PObj = Processor()
        response = PObj.procesar_archivo(rutaArchivo)

        if response["status"]:
            messagebox.showinfo(message=response["message"], title="Todo cool :)")
        else:
            messagebox.showerror(message=response["message"], title="Error :/")
    else:
        messagebox.showinfo(message="ingrese un archivo", title="Info")


ventana = Tk()
ventana.title("Problema 1")
ventana.geometry("450x300")
ventana.resizable(0, 0)


btn = Button(
    ventana,
    text="Buscar archivo",
    command=callback,
)
btn.place(x=175, y=135, width=100, height=30)


ventana.mainloop()
