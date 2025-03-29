document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-comentario');
    const listaComentarios = document.getElementById('lista-comentarios');

    console.log('Form:', form);
    console.log('Lista Comentarios:', listaComentarios);

    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const dados = new FormData(this);
                console.log('Dados do Formulário:', Array.from(dados.entries())); // Log dos dados do formulário
                const response = await fetch('/comentarios/includes/processar_comentario.php', {
                    method: 'POST',
                    body: dados
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Resposta da API:', data);
                
                if (data.sucesso) {
                    // Adiciona o comentário na lista
                    const novoComentario = `
                        <div class="comentario">
                            <div class="comentario-header">
                                <strong>${dados.get('nome')}</strong>
                                <span class="data">Agora mesmo</span>
                            </div>
                            <div class="comentario-texto">
                                ${dados.get('comentario')}
                            </div>
                        </div>
                    `;
                    
                    listaComentarios.insertAdjacentHTML('afterbegin', novoComentario);
                    form.reset();
                    
                    // Mensagem de sucesso
                    mostrarMensagem('Comentário enviado com sucesso!', 'success');
                } else {
                    throw new Error(data.mensagem || 'Erro ao enviar comentário');
                }
            } catch (error) {
                console.error('Erro ao enviar comentário:', error);
                mostrarMensagem('Erro ao enviar comentário. Tente novamente.', 'error');
            }
        });
    }

    function mostrarMensagem(texto, tipo) {
        const mensagem = document.createElement('div');
        mensagem.className = `alert alert-${tipo === 'success' ? 'success' : 'danger'}`;
        mensagem.textContent = texto;
        
        const container = document.querySelector('.comentarios-section');
        console.log('Container de Mensagem:', container);
        container.insertBefore(mensagem, form);
        
        setTimeout(() => mensagem.remove(), 3000);
    }

    async function carregarComentarios() {
        try {
            const response = await fetch('/comentarios/includes/exibir_comentarios.php');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const html = await response.text();
            console.log('Comentários carregados:', html);
            listaComentarios.innerHTML = html;
        } catch (error) {
            console.error('Erro ao carregar comentários:', error);
        }
    }

    // Chame a função para carregar os comentários quando a página for carregada
    carregarComentarios();
});