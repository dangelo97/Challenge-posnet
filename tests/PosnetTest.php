use PHPUnit\Framework\TestCase;

class PosnetTest extends TestCase {

    public function testRegisterCardSuccess() {
        $posnet = new Posnet();
        $posnet->registerCard('41111111', 'Visa', 1000, 'John Doe');

        $cards = $this->getCards($posnet); // Método para obtener las tarjetas registradas
        $this->assertCount(1, $cards); // Verifica que se haya registrado una tarjeta
        $this->assertEquals('41111111', $cards[0]->number); // Verifica el número de la tarjeta
    }

    public function testRegisterCardFail_InvalidCardNumber() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid card number or type.');

        $posnet = new Posnet();
        $posnet->registerCard('12345678', 'Visa', 1000, 'John Doe'); // Tarjeta inválida
    }

    public function testDoPaymentSuccess() {
        $posnet = new Posnet();
        $posnet->registerCard('41111111', 'Visa', 1000, 'John Doe');

        $ticket = $posnet->doPayment('41111111', 100, 1); // Pago sin cuotas adicionales
        $this->assertArrayHasKey('holder', $ticket); // Verifica que el ticket contiene el nombre del titular
        $this->assertEquals(100, $ticket['totalAmount']); // Verifica el monto total
    }

    public function testDoPaymentFail_InsufficientLimit() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Insufficient limit.');

        $posnet = new Posnet();
        $posnet->registerCard('41111111', 'Visa', 100, 'John Doe'); // Limite de 100

        $posnet->doPayment('41111111', 200, 1); // Intento de pago mayor al límite
    }

    // Método auxiliar para obtener las tarjetas registradas
    private function getCards($posnet) {
        // Este método dependerá de la implementación de la clase Posnet
        // Si las tarjetas están almacenadas en $this->cards, puedes devolverlas así
        return $posnet->cards;
    }
}
