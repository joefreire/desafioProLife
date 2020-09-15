@component('mail::message')
Olá **{{$nome}}**,  
Obrigada pelo seu contato!

As seguintes informações foram enviadas:  
- Nome: {{$nome}}  
- E-mail: {{$email}}  
- Telefone: {{$telefone}}  
- Mensagem: {{$mensagem}}  
- IP de origem: {{$ip_origem}}  
- Data de envio: {{$created_at}}  

Atencionsamente,  
Cecilia.
@endcomponent