<form action="contacto.php" method="post">
  <div class="elem-group">
    <label for="name">Escriba aqui su nombre</label>
    <input type="text" id="name" name="visitor_name" placeholder="Maripili Gonzalez" pattern=[A-Z\sa-z]{3,20} required>
  </div>
  <div class="elem-group">
    <label for="email">Escribe aqui tu email</label>
    <input type="email" id="email" name="visitor_email" placeholder="mail@mail.com" required>
  </div>
  <div class="elem-group">
    <label for="seleccion-motivo">Elija el motivo de su consulta</label>
    <select id="seleccion-motivo" name="motivo-consulta" required>
        <option value="">Seleccione un motivo</option>
        <option value="queja">Queja</option>
        <option value="reserva">Reserva de alojamiento</option>
        <option value="masinfo">Más información</option>
        <option value="otro">Otro Motivo</option>
    </select>
  </div>
  <div class="elem-group">
    <label for="title">Escriba aqui el asunto del mensaje</label>
    <input type="text" id="title" name="email_title" required placeholder="No puedo restablecer mi contraseña" pattern=[A-Za-z0-9\s]{8,60}>
  </div>
  <div class="elem-group">
    <label for="message">Escribe aqui tu mensaje</label>
    <textarea id="message" name="visitor_message" placeholder="Escriba aqui su mensaje" required></textarea>
  </div>
  <button type="submit">Enviar Mensaje</button>
</form>


