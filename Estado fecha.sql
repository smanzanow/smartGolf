Select ju.Nombre, Count(*), sum(g.Golpes - h.Par) Puntos  
from puntuacion g 
left join Hoyo h on g.IdHoyo = h.Id
left join juego j on j.id = g.IdJuego
Left join jugardor ju on ju.Id = j.IdJugador
Left join cancha c on c.id = h.idCancha
group by ju.Nombre
order by Puntos