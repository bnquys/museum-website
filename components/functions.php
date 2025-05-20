<?php
    $museum = $dataManager->read('museum_info');
?>

<div id="card" class="container my-5">
    <div class="row justify-content-evenly">
        <div class="col-md-4 mv-tb">
            <div class="card mx-auto p-3 h-100 border-0 rounded-0">
                <div class="card-content text-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="50"
                        fill="var(--dark-cl)"
                        class="bi bi-alarm mx-auto mt-3"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"
                        />
                        <path
                            d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"
                        />
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title text-center">Openning Hours</h5>
                        <p class="card-text text-center">
                            Plan your visit with ease—check our daily and
                            seasonal opening times.
                        </p>
                    </div>
                </div>
                <div class="card-hover text-center">
					<h5 style="word-spacing: 2px; line-height: 1.5;">
                        <?= str_replace(',', '<br>', $museum['summary'])?>
					</h5>
                    <!-- <button
                        class="btn btn-success rounded-0 fw-bold text-uppercase fs-6"
                    >
                        Learn More
                    </button> -->
                </div>
            </div>
        </div>
        <div class="col-md-4 my-3 my-md-0 mv-bt">
            <div class="card mx-auto p-3 h-100 card-content border-0 rounded-0">
                <div class="card-content text-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="50"
                        fill="var(--dark-cl)"
                        class="bi bi-rocket-takeoff mx-auto mt-3"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M9.752 6.193c.599.6 1.73.437 2.528-.362s.96-1.932.362-2.531c-.599-.6-1.73-.438-2.528.361-.798.8-.96 1.933-.362 2.532"
                        />
                        <path
                            d="M15.811 3.312c-.363 1.534-1.334 3.626-3.64 6.218l-.24 2.408a2.56 2.56 0 0 1-.732 1.526L8.817 15.85a.51.51 0 0 1-.867-.434l.27-1.899c.04-.28-.013-.593-.131-.956a9 9 0 0 0-.249-.657l-.082-.202c-.815-.197-1.578-.662-2.191-1.277-.614-.615-1.079-1.379-1.275-2.195l-.203-.083a10 10 0 0 0-.655-.248c-.363-.119-.675-.172-.955-.132l-1.896.27A.51.51 0 0 1 .15 7.17l2.382-2.386c.41-.41.947-.67 1.524-.734h.006l2.4-.238C9.005 1.55 11.087.582 12.623.208c.89-.217 1.59-.232 2.08-.188.244.023.435.06.57.093q.1.026.16.045c.184.06.279.13.351.295l.029.073a3.5 3.5 0 0 1 .157.721c.055.485.051 1.178-.159 2.065m-4.828 7.475.04-.04-.107 1.081a1.54 1.54 0 0 1-.44.913l-1.298 1.3.054-.38c.072-.506-.034-.993-.172-1.418a9 9 0 0 0-.164-.45c.738-.065 1.462-.38 2.087-1.006M5.205 5c-.625.626-.94 1.351-1.004 2.09a9 9 0 0 0-.45-.164c-.424-.138-.91-.244-1.416-.172l-.38.054 1.3-1.3c.245-.246.566-.401.91-.44l1.08-.107zm9.406-3.961c-.38-.034-.967-.027-1.746.163-1.558.38-3.917 1.496-6.937 4.521-.62.62-.799 1.34-.687 2.051.107.676.483 1.362 1.048 1.928.564.565 1.25.941 1.924 1.049.71.112 1.429-.067 2.048-.688 3.079-3.083 4.192-5.444 4.556-6.987.183-.771.18-1.345.138-1.713a3 3 0 0 0-.045-.283 3 3 0 0 0-.3-.041Z"
                        />
                        <path
                            d="M7.009 12.139a7.6 7.6 0 0 1-1.804-1.352A7.6 7.6 0 0 1 3.794 8.86c-1.102.992-1.965 5.054-1.839 5.18.125.126 3.936-.896 5.054-1.902Z"
                        />
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Ongoing Exhibition
                        </h5>
                        <p class="card-text text-center">
                            Explore our current showcase on nature's
                            transformation through time.
                        </p>
                    </div>
                </div>
                <div class="card-hover text-center">
					<h5 style="word-spacing: 2px; line-height: 1.5;">
						Here, we focus on <br> 
						nature's <strong>story—its change</strong> <br>
						and our evolving place <br> within it.
					</h5>
                    <button
                        class="btn btn-success rounded-0 fw-bold text-uppercase fs-6"
                    >
                        Learn More
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mv-tb">
            <div class="card mx-auto p-3 h-100 card-content border-0 rounded-0">
                <div class="card-content text-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="50"
                        fill="var(--dark-cl)"
                        class="bi bi-calendar-event mx-auto mt-3"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"
                        />
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"
                        />
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title text-center">Opening Events</h5>
                        <p class="card-text text-center">
                            Join special talks, guided tours, and live nature
                            demos on launch day.
                        </p>
                    </div>
                </div>
                <div class="card-hover text-center">
					<h5 style="word-spacing: 2px; line-height: 1.5;">
						Here, we focus on <br> 
						special <strong>moments—talks</strong> <br>
						and hands-on nature experiences.
					</h5>
                    <a
						href="event.php"
                        class="btn btn-success rounded-0 fw-bold text-uppercase fs-6"
                    >
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
