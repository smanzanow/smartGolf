Select ju.Nombre, c.Nombre, h.Numero, h.Par , g.Golpes 
from puntuacion g 
left join Hoyo h on g.IdHoyo = h.Id
left join juego j on j.id = g.IdJuego
Left join jugardor ju on ju.Id = j.IdJugador
Left join cancha c on c.id = h.idCancha
order by ju.Nombre, c.Nombre, h.numero