
<h3><span style="font-size: 25px; font-weight: 200; line-height: 50px;">[CS231n]</span><br>E1Q1: k-Nearest Neighbor Classifier</h3>
<p class="article-description" style="font-size: 12px">In pattern recognition, the k-nearest neighbors algorithm (k-NN) is a non-parametric method used for classification and regression. In this assignment we utilize a very basic implementation to predict image labels in the CIFAR-10 Dataset.</p>

<p class="article-number">5</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200;">[CS231n]</span> E1Q1: k-Nearest Neighbor Classifier
			</div>
			<div class="modal-close">
				<svg class="rb-close" viewbox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
				<g fill-rule="evenodd">
					<path d="m1881.15 32.13l-7.07-7.07-1.414 1.414 7.07 7.07-7.07 7.07 1.414 1.414 7.07-7.07 7.07 7.07 1.414-1.414-7.07-7.07 7.07-7.07-1.414-1.414-7.07 7.07" fill="#222222" fill="#fff" transform="translate(-1872-25)"></path>
				</g></svg>
			</div>
		</div>

		<article class="article-body">
			<header class="article-header">
				<div class="article-title">
					<h1><span style="font-size: 25px; font-weight: 200;">[CS231n]</span> <br>E1Q1: k-Nearest Neighbor Classifier</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published June. 27, 2017</p>
				</div>
			</header>
			<main>
			<div class="article_content" style="text-align: left;">

				<b><p>The kNN classifier consists of two stages:</p></b>
				<p>- During training, the classifier takes the training data and simply remembers it</p>
				<p>- During testing, kNN classifies every test image by comparing to all training images and transfering the labels of the k most similar training examples</p>
				<p>- The value of k is cross-validated</p>
				<p>In the following we will implement these steps to better understand the basic Image Classification pipeline, cross-validation, and gain proficiency in writing efficient, vectorized code.</p>
				<p></p>


<h2>INITIAL SETUP</h2>

<div class="cell border-box-sizing text_cell rendered">
<div class="prompt input_prompt">
</div>
<div class="inner_cell">
<div class="text_cell_render border-box-sizing rendered_html">
<h1 id="Q1:-k-Nearest-Neighbor-classifier">Q1: k-Nearest Neighbor classifier<a class="anchor-link" href="#Q1:-k-Nearest-Neighbor-classifier">&#182;</a></h1>
</div>
</div>
</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[1]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Run some setup code for this notebook.</span>

<span class="kn">import</span> <span class="nn">random</span>
<span class="kn">import</span> <span class="nn">numpy</span> <span class="k">as</span> <span class="nn">np</span>
<span class="kn">from</span> <span class="nn">cs231n.data_utils</span> <span class="k">import</span> <span class="n">load_CIFAR10</span>
<span class="kn">import</span> <span class="nn">matplotlib.pyplot</span> <span class="k">as</span> <span class="nn">plt</span>

<span class="kn">from</span> <span class="nn">__future__</span> <span class="k">import</span> <span class="n">print_function</span>

<span class="c"># This is a bit of magic to make matplotlib figures appear inline in the notebook</span>
<span class="c"># rather than in a new window.</span>
<span class="o">%</span><span class="k">matplotlib</span> inline
<span class="n">plt</span><span class="o">.</span><span class="n">rcParams</span><span class="p">[</span><span class="s">&#39;figure.figsize&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="p">(</span><span class="mf">10.0</span><span class="p">,</span> <span class="mf">8.0</span><span class="p">)</span> <span class="c"># set default size of plots</span>
<span class="n">plt</span><span class="o">.</span><span class="n">rcParams</span><span class="p">[</span><span class="s">&#39;image.interpolation&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="s">&#39;nearest&#39;</span>
<span class="n">plt</span><span class="o">.</span><span class="n">rcParams</span><span class="p">[</span><span class="s">&#39;image.cmap&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="s">&#39;gray&#39;</span>

<span class="c"># Some more magic so that the notebook will reload external python modules;</span>
<span class="c"># see http://stackoverflow.com/questions/1907993/autoreload-of-modules-in-ipython</span>
<span class="o">%</span><span class="k">load_ext</span> autoreload
<span class="o">%</span><span class="k">autoreload</span> 2
</pre></div>

</div>
</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[2]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Load the raw CIFAR-10 data.</span>
<span class="n">cifar10_dir</span> <span class="o">=</span> <span class="s">&#39;cs231n/datasets/cifar-10-batches-py&#39;</span>
<span class="n">X_train</span><span class="p">,</span> <span class="n">y_train</span><span class="p">,</span> <span class="n">X_test</span><span class="p">,</span> <span class="n">y_test</span> <span class="o">=</span> <span class="n">load_CIFAR10</span><span class="p">(</span><span class="n">cifar10_dir</span><span class="p">)</span>

<span class="c"># As a sanity check, we print out the size of the training and test data.</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Training data shape: &#39;</span><span class="p">,</span> <span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Training labels shape: &#39;</span><span class="p">,</span> <span class="n">y_train</span><span class="o">.</span><span class="n">shape</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Test data shape: &#39;</span><span class="p">,</span> <span class="n">X_test</span><span class="o">.</span><span class="n">shape</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Test labels shape: &#39;</span><span class="p">,</span> <span class="n">y_test</span><span class="o">.</span><span class="n">shape</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Training data shape:  (50000, 32, 32, 3)
Training labels shape:  (50000,)
Test data shape:  (10000, 32, 32, 3)
Test labels shape:  (10000,)
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[3]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Visualize some examples from the dataset.</span>
<span class="c"># We show a few examples of training images from each class.</span>
<span class="n">classes</span> <span class="o">=</span> <span class="p">[</span><span class="s">&#39;plane&#39;</span><span class="p">,</span> <span class="s">&#39;car&#39;</span><span class="p">,</span> <span class="s">&#39;bird&#39;</span><span class="p">,</span> <span class="s">&#39;cat&#39;</span><span class="p">,</span> <span class="s">&#39;deer&#39;</span><span class="p">,</span> <span class="s">&#39;dog&#39;</span><span class="p">,</span> <span class="s">&#39;frog&#39;</span><span class="p">,</span> <span class="s">&#39;horse&#39;</span><span class="p">,</span> <span class="s">&#39;ship&#39;</span><span class="p">,</span> <span class="s">&#39;truck&#39;</span><span class="p">]</span>
<span class="n">num_classes</span> <span class="o">=</span> <span class="nb">len</span><span class="p">(</span><span class="n">classes</span><span class="p">)</span>
<span class="n">samples_per_class</span> <span class="o">=</span> <span class="mi">7</span>
<span class="k">for</span> <span class="n">y</span><span class="p">,</span> <span class="n">cls</span> <span class="ow">in</span> <span class="nb">enumerate</span><span class="p">(</span><span class="n">classes</span><span class="p">):</span>
    <span class="n">idxs</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">flatnonzero</span><span class="p">(</span><span class="n">y_train</span> <span class="o">==</span> <span class="n">y</span><span class="p">)</span>
    <span class="n">idxs</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">random</span><span class="o">.</span><span class="n">choice</span><span class="p">(</span><span class="n">idxs</span><span class="p">,</span> <span class="n">samples_per_class</span><span class="p">,</span> <span class="n">replace</span><span class="o">=</span><span class="k">False</span><span class="p">)</span>
    <span class="k">for</span> <span class="n">i</span><span class="p">,</span> <span class="n">idx</span> <span class="ow">in</span> <span class="nb">enumerate</span><span class="p">(</span><span class="n">idxs</span><span class="p">):</span>
        <span class="n">plt_idx</span> <span class="o">=</span> <span class="n">i</span> <span class="o">*</span> <span class="n">num_classes</span> <span class="o">+</span> <span class="n">y</span> <span class="o">+</span> <span class="mi">1</span>
        <span class="n">plt</span><span class="o">.</span><span class="n">subplot</span><span class="p">(</span><span class="n">samples_per_class</span><span class="p">,</span> <span class="n">num_classes</span><span class="p">,</span> <span class="n">plt_idx</span><span class="p">)</span>
        <span class="n">plt</span><span class="o">.</span><span class="n">imshow</span><span class="p">(</span><span class="n">X_train</span><span class="p">[</span><span class="n">idx</span><span class="p">]</span><span class="o">.</span><span class="n">astype</span><span class="p">(</span><span class="s">&#39;uint8&#39;</span><span class="p">))</span>
        <span class="n">plt</span><span class="o">.</span><span class="n">axis</span><span class="p">(</span><span class="s">&#39;off&#39;</span><span class="p">)</span>
        <span class="k">if</span> <span class="n">i</span> <span class="o">==</span> <span class="mi">0</span><span class="p">:</span>
            <span class="n">plt</span><span class="o">.</span><span class="n">title</span><span class="p">(</span><span class="n">cls</span><span class="p">)</span>
<span class="n">plt</span><span class="o">.</span><span class="n">show</span><span class="p">()</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>


<div class="output_png output_subarea ">
<img src="./img/a5/knn_1.png" style="width: 70%; margin-left: 15%;">
</div>

</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[4]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Subsample the data for more efficient code execution in this exercise</span>
<span class="n">num_training</span> <span class="o">=</span> <span class="mi">5000</span>
<span class="n">mask</span> <span class="o">=</span> <span class="nb">list</span><span class="p">(</span><span class="nb">range</span><span class="p">(</span><span class="n">num_training</span><span class="p">))</span>
<span class="n">X_train</span> <span class="o">=</span> <span class="n">X_train</span><span class="p">[</span><span class="n">mask</span><span class="p">]</span>
<span class="n">y_train</span> <span class="o">=</span> <span class="n">y_train</span><span class="p">[</span><span class="n">mask</span><span class="p">]</span>

<span class="n">num_test</span> <span class="o">=</span> <span class="mi">500</span>
<span class="n">mask</span> <span class="o">=</span> <span class="nb">list</span><span class="p">(</span><span class="nb">range</span><span class="p">(</span><span class="n">num_test</span><span class="p">))</span>
<span class="n">X_test</span> <span class="o">=</span> <span class="n">X_test</span><span class="p">[</span><span class="n">mask</span><span class="p">]</span>
<span class="n">y_test</span> <span class="o">=</span> <span class="n">y_test</span><span class="p">[</span><span class="n">mask</span><span class="p">]</span>
</pre></div>

</div>
</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[5]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Reshape the image data into rows</span>
<span class="n">X_train</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">reshape</span><span class="p">(</span><span class="n">X_train</span><span class="p">,</span> <span class="p">(</span><span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">],</span> <span class="o">-</span><span class="mi">1</span><span class="p">))</span>
<span class="n">X_test</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">reshape</span><span class="p">(</span><span class="n">X_test</span><span class="p">,</span> <span class="p">(</span><span class="n">X_test</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">],</span> <span class="o">-</span><span class="mi">1</span><span class="p">))</span>
<span class="nb">print</span><span class="p">(</span><span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">,</span> <span class="n">X_test</span><span class="o">.</span><span class="n">shape</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>(5000, 3072) (500, 3072)
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[6]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="kn">from</span> <span class="nn">cs231n.classifiers</span> <span class="k">import</span> <span class="n">KNearestNeighbor</span>

<span class="c"># Create a kNN classifier instance. </span>
<span class="c"># Remember that training a kNN classifier is a noop: </span>
<span class="c"># the Classifier simply remembers the data and does no further processing </span>
<span class="n">classifier</span> <span class="o">=</span> <span class="n">KNearestNeighbor</span><span class="p">()</span>
<span class="n">classifier</span><span class="o">.</span><span class="n">train</span><span class="p">(</span><span class="n">X_train</span><span class="p">,</span> <span class="n">y_train</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

</div>

<div class="article_analysis">
<p><b>We would now like to classify the test data with the kNN classifier. Recall that we can break down this process into two steps:</b></p>
<p>1. First we must compute the distances between all test examples and all train examples.</p>
<p>2. Given these distances, for each test example we find the k nearest examples and have them vote for the label</p>
<p>Lets begin with computing the distance matrix between all training and test examples. For example, if there are <b>Ntr</b> training examples and <b>Nte</b> test examples, this stage should result in a <b>Nte x Ntr</b> matrix where each element (i,j) is the distance between the i-th test and j-th train example.</p>
<p>First, open `cs231n/classifiers/k_nearest_neighbor.py` and implement the function `compute_distances_two_loops` that uses a (very inefficient) double loop over all pairs of (test, train) examples and computes the distance matrix one element at a time.</p>
</div>

<div class="cell border-box-sizing text_cell rendered">
<div class="prompt input_prompt">
</div>
<div class="inner_cell">
<div class="text_cell_render border-box-sizing rendered_html">
<p>We would now like to classify the test data with the kNN classifier. Recall that we can break down this process into two steps:</p>
<ol>
<li>First we must compute the distances between all test examples and all train examples. </li>
<li>Given these distances, for each test example we find the k nearest examples and have them vote for the label</li>
</ol>
<p>Lets begin with computing the distance matrix between all training and test examples. For example, if there are <strong>Ntr</strong> training examples and <strong>Nte</strong> test examples, this stage should result in a <strong>Nte x Ntr</strong> matrix where each element (i,j) is the distance between the i-th test and j-th train example.</p>
<p>First, open <code>cs231n/classifiers/k_nearest_neighbor.py</code> and implement the function <code>compute_distances_two_loops</code> that uses a (very inefficient) double loop over all pairs of (test, train) examples and computes the distance matrix one element at a time.</p>

</div>
</div>
</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[7]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Open cs231n/classifiers/k_nearest_neighbor.py and implement</span>
<span class="c"># compute_distances_two_loops.</span>

<span class="c"># Test your implementation:</span>
<span class="n">dists</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_two_loops</span><span class="p">(</span><span class="n">X_test</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&quot;Shape: &quot;</span> <span class="o">+</span> <span class="nb">str</span><span class="p">(</span><span class="n">dists</span><span class="o">.</span><span class="n">shape</span><span class="p">))</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Computing Distance:  0
Computing Distance:  25
Computing Distance:  50
Computing Distance:  75
Computing Distance:  100
Computing Distance:  125
Computing Distance:  150
Computing Distance:  175
Computing Distance:  200
Computing Distance:  225
Computing Distance:  250
Computing Distance:  275
Computing Distance:  300
Computing Distance:  325
Computing Distance:  350
Computing Distance:  375
Computing Distance:  400
Computing Distance:  425
Computing Distance:  450
Computing Distance:  475
Shape: (500, 5000)
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[23]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># We can visualize the distance matrix: each row is a single test example and</span>
<span class="c"># its distances to training examples</span>
<span class="n">plt</span><span class="o">.</span><span class="n">imshow</span><span class="p">(</span><span class="n">dists</span><span class="p">,</span> <span class="n">interpolation</span><span class="o">=</span><span class="s">&#39;none&#39;</span><span class="p">)</span>
<span class="n">plt</span><span class="o">.</span><span class="n">show</span><span class="p">()</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>


<div class="output_png output_subarea ">
	<img src="./img/a5/knn_2.png" style="width: 100%; margin-left: 0%;">
</div>

</div>

</div>
</div>

<div class="article_analysis">
<h3><b>INLINE QUESTION #1:</b></h3>
<p><b>1. What in the data is the cause behind the distinctly bright rows?</b></p>
<p>The rows represent each test image and every column in that row is it's similarity to the 5000 training images. If the pixel for row i column j is white then we see high distances, or rather no similarity between test and training image. Thus a row (test image) that is distinctly bright means that the test image has very few similar images in the entire training set.</p>
<p><b>2. What causes the columns?</b></p>
<p>Similar to the explanation above, the white columns represent images in the training set that are similar to very few of the test images, as most of the 0-500 test images show large L2 distances (bright).</p>

</div>

</div>
<div class="cell border-box-sizing text_cell rendered">
<div class="prompt input_prompt">
</div>
<div class="inner_cell">
<div class="text_cell_render border-box-sizing rendered_html">
<p>INLINE QUESTION #1:</p>
<ol>
<li><p>The rows represent each test image and every column in that row is it's similarity to the 5000 training images. If the pixel for row i column j is white then we see high distances, or rather no similarity between test and training image. Thus a row (test image) that is distinctly bright means that the test image has very few similar images in the entire training set.</p>
</li>
<li><p>Similar to the explanation above, the white columns represent images in the training set that are similar to very few of the test images, as most of the 0-500 test images show large L2 distances (bright).</p>
</li>
</ol>

</div>
</div>
</div>

<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[42]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Now implement the function predict_labels and run the code below:</span>
<span class="c"># We use k = 1 (which is Nearest Neighbor).</span>
<span class="n">y_test_pred</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">predict_labels</span><span class="p">(</span><span class="n">dists</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="mi">1</span><span class="p">)</span>

<span class="c"># Compute and print the fraction of correctly predicted examples</span>
<span class="n">num_correct</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">y_test_pred</span> <span class="o">==</span> <span class="n">y_test</span><span class="p">)</span>
<span class="n">accuracy</span> <span class="o">=</span> <span class="nb">float</span><span class="p">(</span><span class="n">num_correct</span><span class="p">)</span> <span class="o">/</span> <span class="n">num_test</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Got %d / %d correct =&gt; accuracy: %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">num_correct</span><span class="p">,</span> <span class="n">num_test</span><span class="p">,</span> <span class="n">accuracy</span><span class="p">))</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Got 137 / 500 correct =&gt; accuracy: 0.274000
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[109]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="n">y_test_pred</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">predict_labels</span><span class="p">(</span><span class="n">dists</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="mi">5</span><span class="p">)</span>
<span class="n">num_correct</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">y_test_pred</span> <span class="o">==</span> <span class="n">y_test</span><span class="p">)</span>
<span class="n">accuracy</span> <span class="o">=</span> <span class="nb">float</span><span class="p">(</span><span class="n">num_correct</span><span class="p">)</span> <span class="o">/</span> <span class="n">num_test</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Got %d / %d correct =&gt; accuracy: %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">num_correct</span><span class="p">,</span> <span class="n">num_test</span><span class="p">,</span> <span class="n">accuracy</span><span class="p">))</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Got 145 / 500 correct =&gt; accuracy: 0.290000
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[46]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Now lets speed up distance matrix computation by using partial vectorization</span>
<span class="c"># with one loop. Implement the function compute_distances_one_loop and run the</span>
<span class="c"># code below:</span>
<span class="n">dists_one</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_one_loop</span><span class="p">(</span><span class="n">X_test</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Computing Distance:  0
Computing Distance:  25
Computing Distance:  50
Computing Distance:  75
Computing Distance:  100
Computing Distance:  125
Computing Distance:  150
Computing Distance:  175
Computing Distance:  200
Computing Distance:  225
Computing Distance:  250
Computing Distance:  275
Computing Distance:  300
Computing Distance:  325
Computing Distance:  350
Computing Distance:  375
Computing Distance:  400
Computing Distance:  425
Computing Distance:  450
Computing Distance:  475
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[47]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># To ensure that our vectorized implementation is correct, we make sure that it</span>
<span class="c"># agrees with the naive implementation. There are many ways to decide whether</span>
<span class="c"># two matrices are similar; one of the simplest is the Frobenius norm. In case</span>
<span class="c"># you haven&#39;t seen it before, the Frobenius norm of two matrices is the square</span>
<span class="c"># root of the squared sum of differences of all elements; in other words, reshape</span>
<span class="c"># the matrices into vectors and compute the Euclidean distance between them.</span>
<span class="n">difference</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">linalg</span><span class="o">.</span><span class="n">norm</span><span class="p">(</span><span class="n">dists</span> <span class="o">-</span> <span class="n">dists_one</span><span class="p">,</span> <span class="nb">ord</span><span class="o">=</span><span class="s">&#39;fro&#39;</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Difference was: %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">difference</span><span class="p">,</span> <span class="p">))</span>
<span class="k">if</span> <span class="n">difference</span> <span class="o">&lt;</span> <span class="mf">0.001</span><span class="p">:</span>
    <span class="nb">print</span><span class="p">(</span><span class="s">&#39;Good! The distance matrices are the same&#39;</span><span class="p">)</span>
<span class="k">else</span><span class="p">:</span>
    <span class="nb">print</span><span class="p">(</span><span class="s">&#39;Uh-oh! The distance matrices are different&#39;</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Difference was: 0.000000
Good! The distance matrices are the same
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[59]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Now implement the fully vectorized version inside compute_distances_no_loops</span>
<span class="c"># and run the code</span>
<span class="n">dists_two</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_no_loops</span><span class="p">(</span><span class="n">X_test</span><span class="p">)</span>

<span class="c"># check that the distance matrix agrees with the one we computed before:</span>
<span class="n">difference</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">linalg</span><span class="o">.</span><span class="n">norm</span><span class="p">(</span><span class="n">dists</span> <span class="o">-</span> <span class="n">dists_two</span><span class="p">,</span> <span class="nb">ord</span><span class="o">=</span><span class="s">&#39;fro&#39;</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Difference was: %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">difference</span><span class="p">,</span> <span class="p">))</span>
<span class="k">if</span> <span class="n">difference</span> <span class="o">&lt;</span> <span class="mf">0.001</span><span class="p">:</span>
    <span class="nb">print</span><span class="p">(</span><span class="s">&#39;Good! The distance matrices are the same&#39;</span><span class="p">)</span>
<span class="k">else</span><span class="p">:</span>
    <span class="nb">print</span><span class="p">(</span><span class="s">&#39;Uh-oh! The distance matrices are different&#39;</span><span class="p">)</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Difference was: 0.000000
Good! The distance matrices are the same
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[53]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Let&#39;s compare how fast the implementations are</span>
<span class="k">def</span> <span class="nf">time_function</span><span class="p">(</span><span class="n">f</span><span class="p">,</span> <span class="o">*</span><span class="n">args</span><span class="p">):</span>
    <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">    Call a function f with args and return the time (in seconds) that it took to execute.</span>
<span class="sd">    &quot;&quot;&quot;</span>
    <span class="kn">import</span> <span class="nn">time</span>
    <span class="n">tic</span> <span class="o">=</span> <span class="n">time</span><span class="o">.</span><span class="n">time</span><span class="p">()</span>
    <span class="n">f</span><span class="p">(</span><span class="o">*</span><span class="n">args</span><span class="p">)</span>
    <span class="n">toc</span> <span class="o">=</span> <span class="n">time</span><span class="o">.</span><span class="n">time</span><span class="p">()</span>
    <span class="k">return</span> <span class="n">toc</span> <span class="o">-</span> <span class="n">tic</span>

<span class="n">two_loop_time</span> <span class="o">=</span> <span class="n">time_function</span><span class="p">(</span><span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_two_loops</span><span class="p">,</span> <span class="n">X_test</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Two loop version took %f seconds&#39;</span> <span class="o">%</span> <span class="n">two_loop_time</span><span class="p">)</span>

<span class="n">one_loop_time</span> <span class="o">=</span> <span class="n">time_function</span><span class="p">(</span><span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_one_loop</span><span class="p">,</span> <span class="n">X_test</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;One loop version took %f seconds&#39;</span> <span class="o">%</span> <span class="n">one_loop_time</span><span class="p">)</span>

<span class="n">no_loop_time</span> <span class="o">=</span> <span class="n">time_function</span><span class="p">(</span><span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_no_loops</span><span class="p">,</span> <span class="n">X_test</span><span class="p">)</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;No loop version took %f seconds&#39;</span> <span class="o">%</span> <span class="n">no_loop_time</span><span class="p">)</span>

<span class="c"># you should see significantly faster performance with the fully vectorized implementation</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>FINISHED WITH TEST IMAGE:  0
FINISHED WITH TEST IMAGE:  50
FINISHED WITH TEST IMAGE:  100
FINISHED WITH TEST IMAGE:  150
FINISHED WITH TEST IMAGE:  200
FINISHED WITH TEST IMAGE:  250
FINISHED WITH TEST IMAGE:  300
FINISHED WITH TEST IMAGE:  350
FINISHED WITH TEST IMAGE:  400
FINISHED WITH TEST IMAGE:  450
Two loop version took 32.644345 seconds
FINISHED WITH TEST IMAGE:  0
FINISHED WITH TEST IMAGE:  50
FINISHED WITH TEST IMAGE:  100
FINISHED WITH TEST IMAGE:  150
FINISHED WITH TEST IMAGE:  200
FINISHED WITH TEST IMAGE:  250
FINISHED WITH TEST IMAGE:  300
FINISHED WITH TEST IMAGE:  350
FINISHED WITH TEST IMAGE:  400
FINISHED WITH TEST IMAGE:  450
One loop version took 75.630863 seconds
No loop version took 0.413558 seconds
</pre>
</div>
</div>

</div>
</div>

</div>


<div class="article_analysis">
<h2><b>CROSS VALIDATION</b></h3>
<p>We have implemented the k-Nearest Neighbor classifier but we set the value k = 5 arbitrarily. We will now determine the best value of this hyperparameter with cross-validation.</p>

</div>

<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[142]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="n">num_folds</span> <span class="o">=</span> <span class="mi">5</span>
<span class="n">k_choices</span> <span class="o">=</span> <span class="p">[</span><span class="mi">1</span><span class="p">,</span> <span class="mi">3</span><span class="p">,</span> <span class="mi">5</span><span class="p">,</span> <span class="mi">8</span><span class="p">,</span> <span class="mi">10</span><span class="p">,</span> <span class="mi">12</span><span class="p">,</span> <span class="mi">15</span><span class="p">,</span> <span class="mi">20</span><span class="p">,</span> <span class="mi">50</span><span class="p">,</span> <span class="mi">100</span><span class="p">]</span>

<span class="n">X_train_folds</span> <span class="o">=</span> <span class="p">[]</span>
<span class="n">y_train_folds</span> <span class="o">=</span> <span class="p">[]</span>

<span class="c">#use numpy array_split function to split the training data into num_folds folds</span>
<span class="n">X_train_folds</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array_split</span><span class="p">(</span><span class="n">X_train</span><span class="p">,</span> <span class="n">num_folds</span><span class="p">)</span>
<span class="n">y_train_folds</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array_split</span><span class="p">(</span><span class="n">y_train</span><span class="p">,</span> <span class="n">num_folds</span><span class="p">)</span>

<span class="c"># A dictionary holding the accuracies for different values of k that we find</span>
<span class="c"># when running cross-validation. After running cross-validation,</span>
<span class="c"># k_to_accuracies[k] should be a list of length num_folds giving the different</span>
<span class="c"># accuracy values that we found when using that value of k.</span>
<span class="n">k_to_accuracies</span> <span class="o">=</span> <span class="p">{}</span>

<span class="k">for</span> <span class="n">k</span> <span class="ow">in</span> <span class="n">k_choices</span><span class="p">:</span>
    <span class="n">k_to_accuracies</span><span class="p">[</span><span class="n">k</span><span class="p">]</span> <span class="o">=</span> <span class="p">[]</span>
    <span class="c"># Run kNN algorithm num_folds times</span>
    <span class="k">for</span> <span class="n">i</span> <span class="ow">in</span> <span class="nb">range</span><span class="p">(</span><span class="n">num_folds</span><span class="p">):</span>
        <span class="n">X_train</span> <span class="o">=</span> <span class="p">[]</span>
        <span class="n">y_train</span> <span class="o">=</span> <span class="p">[]</span>
        <span class="k">for</span> <span class="n">j</span> <span class="ow">in</span> <span class="nb">range</span><span class="p">(</span><span class="n">num_folds</span><span class="p">):</span>
            <span class="k">if</span> <span class="n">i</span> <span class="o">!=</span> <span class="n">j</span><span class="p">:</span>
                <span class="n">X_train</span><span class="o">.</span><span class="n">extend</span><span class="p">(</span><span class="n">X_train_folds</span><span class="p">[</span><span class="n">j</span><span class="p">])</span>
                <span class="n">y_train</span><span class="o">.</span><span class="n">extend</span><span class="p">(</span><span class="n">y_train_folds</span><span class="p">[</span><span class="n">j</span><span class="p">])</span>

        <span class="n">X_train</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array</span><span class="p">(</span><span class="n">X_train</span><span class="p">)</span>
        <span class="n">y_train</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array</span><span class="p">(</span><span class="n">y_train</span><span class="p">)</span>
        <span class="n">classifier</span> <span class="o">=</span> <span class="n">KNearestNeighbor</span><span class="p">()</span>
        <span class="n">classifier</span><span class="o">.</span><span class="n">train</span><span class="p">(</span><span class="n">X_train</span><span class="p">,</span> <span class="n">y_train</span><span class="p">)</span>
        <span class="n">dists</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">compute_distances_no_loops</span><span class="p">(</span><span class="n">X_test</span><span class="p">)</span>
        <span class="n">y_test_pred</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">predict_labels</span><span class="p">(</span><span class="n">dists</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="n">k</span><span class="p">)</span>

        <span class="n">num_correct</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">y_test_pred</span> <span class="o">==</span> <span class="n">y_test</span><span class="p">)</span>
        <span class="n">accuracy</span> <span class="o">=</span> <span class="nb">float</span><span class="p">(</span><span class="n">num_correct</span><span class="p">)</span> <span class="o">/</span> <span class="n">num_test</span>

        <span class="n">k_to_accuracies</span><span class="p">[</span><span class="n">k</span><span class="p">]</span><span class="o">.</span><span class="n">append</span><span class="p">(</span><span class="n">accuracy</span><span class="p">)</span>

<span class="c"># Print out the computed accuracies</span>
<span class="k">for</span> <span class="n">k</span> <span class="ow">in</span> <span class="nb">sorted</span><span class="p">(</span><span class="n">k_to_accuracies</span><span class="p">):</span>
    <span class="k">for</span> <span class="n">accuracy</span> <span class="ow">in</span> <span class="n">k_to_accuracies</span><span class="p">[</span><span class="n">k</span><span class="p">]:</span>
        <span class="nb">print</span><span class="p">(</span><span class="s">&#39;k = %d, accuracy = %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">k</span><span class="p">,</span> <span class="n">accuracy</span><span class="p">))</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>k = 1, accuracy = 0.258000
k = 1, accuracy = 0.276000
k = 1, accuracy = 0.260000
k = 1, accuracy = 0.250000
k = 1, accuracy = 0.254000
k = 3, accuracy = 0.276000
k = 3, accuracy = 0.280000
k = 3, accuracy = 0.262000
k = 3, accuracy = 0.272000
k = 3, accuracy = 0.252000
k = 5, accuracy = 0.284000
k = 5, accuracy = 0.294000
k = 5, accuracy = 0.272000
k = 5, accuracy = 0.268000
k = 5, accuracy = 0.280000
k = 8, accuracy = 0.280000
k = 8, accuracy = 0.282000
k = 8, accuracy = 0.282000
k = 8, accuracy = 0.250000
k = 8, accuracy = 0.290000
k = 10, accuracy = 0.274000
k = 10, accuracy = 0.286000
k = 10, accuracy = 0.278000
k = 10, accuracy = 0.260000
k = 10, accuracy = 0.270000
k = 12, accuracy = 0.282000
k = 12, accuracy = 0.266000
k = 12, accuracy = 0.272000
k = 12, accuracy = 0.276000
k = 12, accuracy = 0.280000
k = 15, accuracy = 0.278000
k = 15, accuracy = 0.270000
k = 15, accuracy = 0.250000
k = 15, accuracy = 0.262000
k = 15, accuracy = 0.270000
k = 20, accuracy = 0.274000
k = 20, accuracy = 0.254000
k = 20, accuracy = 0.242000
k = 20, accuracy = 0.258000
k = 20, accuracy = 0.274000
k = 50, accuracy = 0.240000
k = 50, accuracy = 0.234000
k = 50, accuracy = 0.234000
k = 50, accuracy = 0.246000
k = 50, accuracy = 0.234000
k = 100, accuracy = 0.230000
k = 100, accuracy = 0.218000
k = 100, accuracy = 0.224000
k = 100, accuracy = 0.224000
k = 100, accuracy = 0.224000
</pre>
</div>
</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[143]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># plot the raw observations</span>
<span class="k">for</span> <span class="n">k</span> <span class="ow">in</span> <span class="n">k_choices</span><span class="p">:</span>
    <span class="n">accuracies</span> <span class="o">=</span> <span class="n">k_to_accuracies</span><span class="p">[</span><span class="n">k</span><span class="p">]</span>
    <span class="n">plt</span><span class="o">.</span><span class="n">scatter</span><span class="p">([</span><span class="n">k</span><span class="p">]</span> <span class="o">*</span> <span class="nb">len</span><span class="p">(</span><span class="n">accuracies</span><span class="p">),</span> <span class="n">accuracies</span><span class="p">)</span>

<span class="c"># plot the trend line with error bars that correspond to standard deviation</span>
<span class="n">accuracies_mean</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array</span><span class="p">([</span><span class="n">np</span><span class="o">.</span><span class="n">mean</span><span class="p">(</span><span class="n">v</span><span class="p">)</span> <span class="k">for</span> <span class="n">k</span><span class="p">,</span><span class="n">v</span> <span class="ow">in</span> <span class="nb">sorted</span><span class="p">(</span><span class="n">k_to_accuracies</span><span class="o">.</span><span class="n">items</span><span class="p">())])</span>
<span class="n">accuracies_std</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">array</span><span class="p">([</span><span class="n">np</span><span class="o">.</span><span class="n">std</span><span class="p">(</span><span class="n">v</span><span class="p">)</span> <span class="k">for</span> <span class="n">k</span><span class="p">,</span><span class="n">v</span> <span class="ow">in</span> <span class="nb">sorted</span><span class="p">(</span><span class="n">k_to_accuracies</span><span class="o">.</span><span class="n">items</span><span class="p">())])</span>
<span class="n">plt</span><span class="o">.</span><span class="n">errorbar</span><span class="p">(</span><span class="n">k_choices</span><span class="p">,</span> <span class="n">accuracies_mean</span><span class="p">,</span> <span class="n">yerr</span><span class="o">=</span><span class="n">accuracies_std</span><span class="p">)</span>
<span class="n">plt</span><span class="o">.</span><span class="n">title</span><span class="p">(</span><span class="s">&#39;Cross-validation on k&#39;</span><span class="p">)</span>
<span class="n">plt</span><span class="o">.</span><span class="n">xlabel</span><span class="p">(</span><span class="s">&#39;k&#39;</span><span class="p">)</span>
<span class="n">plt</span><span class="o">.</span><span class="n">ylabel</span><span class="p">(</span><span class="s">&#39;Cross-validation accuracy&#39;</span><span class="p">)</span>

<span class="n">plt</span><span class="o">.</span><span class="n">show</span><span class="p">()</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>


<div class="output_png output_subarea ">
<img src="./img/a5/knn_3.png" style="width: 80%; margin-left: 10%;">


</div>

</div>
</div>

</div>
<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[152]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="c"># Based on the cross-validation results above, choose the best value for k,   </span>
<span class="c"># retrain the classifier using all the training data, and test it on the test</span>
<span class="c"># data. You should be able to get above 28% accuracy on the test data.</span>
<span class="n">best_k</span> <span class="o">=</span> <span class="mi">8</span>

<span class="n">classifier</span> <span class="o">=</span> <span class="n">KNearestNeighbor</span><span class="p">()</span>
<span class="n">classifier</span><span class="o">.</span><span class="n">train</span><span class="p">(</span><span class="n">X_train</span><span class="p">,</span> <span class="n">y_train</span><span class="p">)</span>
<span class="n">y_test_pred</span> <span class="o">=</span> <span class="n">classifier</span><span class="o">.</span><span class="n">predict</span><span class="p">(</span><span class="n">X_test</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="n">best_k</span><span class="p">)</span>

<span class="c"># Compute and display the accuracy</span>
<span class="n">num_correct</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">y_test_pred</span> <span class="o">==</span> <span class="n">y_test</span><span class="p">)</span>
<span class="n">accuracy</span> <span class="o">=</span> <span class="nb">float</span><span class="p">(</span><span class="n">num_correct</span><span class="p">)</span> <span class="o">/</span> <span class="n">num_test</span>
<span class="nb">print</span><span class="p">(</span><span class="s">&#39;Got %d / %d correct =&gt; accuracy: %f&#39;</span> <span class="o">%</span> <span class="p">(</span><span class="n">num_correct</span><span class="p">,</span> <span class="n">num_test</span><span class="p">,</span> <span class="n">accuracy</span><span class="p">))</span>
</pre></div>

</div>
</div>
</div>

<div class="output_wrapper">
<div class="output">


<div class="output_area"><div class="prompt"></div>
<div class="output_subarea output_stream output_stdout output_text">
<pre>Got 145 / 500 correct =&gt; accuracy: 0.290000
</pre>
</div>
</div>

</div>
</div>



<h2>K-NEAREST NEIGHBOR CLASS</h2>

<div class="article_analysis">
<p>The following code contains the kNN class and it's containing functions that I use in the above analysis.</p>
</div>

<div class="cell border-box-sizing code_cell rendered">
<div class="input">
<div class="prompt input_prompt">In&nbsp;[&nbsp;]:</div>
<div class="inner_cell">
    <div class="input_area">
<div class=" highlight hl-ipython3"><pre><span class="kn">import</span> <span class="nn">numpy</span> <span class="k">as</span> <span class="nn">np</span>
<span class="kn">from</span> <span class="nn">past.builtins</span> <span class="k">import</span> <span class="n">xrange</span>
<span class="kn">from</span> <span class="nn">collections</span> <span class="k">import</span> <span class="n">Counter</span>

<span class="k">class</span> <span class="nc">KNearestNeighbor</span><span class="p">(</span><span class="nb">object</span><span class="p">):</span>
    <span class="sd">&quot;&quot;&quot; a kNN classifier with L2 distance &quot;&quot;&quot;</span>

    <span class="k">def</span> <span class="nf">__init__</span><span class="p">(</span><span class="bp">self</span><span class="p">):</span>
        <span class="k">pass</span>

    <span class="k">def</span> <span class="nf">train</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">X</span><span class="p">,</span> <span class="n">y</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Train the classifier. For k-nearest neighbors this is just </span>
<span class="sd">        memorizing the training data.</span>

<span class="sd">        Inputs:</span>
<span class="sd">        - X: A numpy array of shape (num_train, D) containing the training data</span>
<span class="sd">          consisting of num_train samples each of dimension D.</span>
<span class="sd">        - y: A numpy array of shape (N,) containing the training labels, where</span>
<span class="sd">             y[i] is the label for X[i].</span>
<span class="sd">        &quot;&quot;&quot;</span>
        <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span> <span class="o">=</span> <span class="n">X</span>
        <span class="bp">self</span><span class="o">.</span><span class="n">y_train</span> <span class="o">=</span> <span class="n">y</span>

    <span class="k">def</span> <span class="nf">predict</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">X</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="mi">1</span><span class="p">,</span> <span class="n">num_loops</span><span class="o">=</span><span class="mi">0</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Predict labels for test data using this classifier.</span>

<span class="sd">        Inputs:</span>
<span class="sd">        - X: A numpy array of shape (num_test, D) containing test data consisting</span>
<span class="sd">             of num_test samples each of dimension D.</span>
<span class="sd">        - k: The number of nearest neighbors that vote for the predicted labels.</span>
<span class="sd">        - num_loops: Determines which implementation to use to compute distances</span>
<span class="sd">          between training points and testing points.</span>

<span class="sd">        Returns:</span>
<span class="sd">        - y: A numpy array of shape (num_test,) containing predicted labels for the</span>
<span class="sd">          test data, where y[i] is the predicted label for the test point X[i].  </span>
<span class="sd">        &quot;&quot;&quot;</span>
        <span class="k">if</span> <span class="n">num_loops</span> <span class="o">==</span> <span class="mi">0</span><span class="p">:</span>
            <span class="n">dists</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">compute_distances_no_loops</span><span class="p">(</span><span class="n">X</span><span class="p">)</span>
        <span class="k">elif</span> <span class="n">num_loops</span> <span class="o">==</span> <span class="mi">1</span><span class="p">:</span>
            <span class="n">dists</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">compute_distances_one_loop</span><span class="p">(</span><span class="n">X</span><span class="p">)</span>
        <span class="k">elif</span> <span class="n">num_loops</span> <span class="o">==</span> <span class="mi">2</span><span class="p">:</span>
            <span class="n">dists</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">compute_distances_two_loops</span><span class="p">(</span><span class="n">X</span><span class="p">)</span>
        <span class="k">else</span><span class="p">:</span>
            <span class="k">raise</span> <span class="ne">ValueError</span><span class="p">(</span><span class="s">&#39;Invalid value %d for num_loops&#39;</span> <span class="o">%</span> <span class="n">num_loops</span><span class="p">)</span>

        <span class="k">return</span> <span class="bp">self</span><span class="o">.</span><span class="n">predict_labels</span><span class="p">(</span><span class="n">dists</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="n">k</span><span class="p">)</span>

    <span class="k">def</span> <span class="nf">compute_distances_two_loops</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">X</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Compute the distance between each test point in X and each training point</span>
<span class="sd">        in self.X_train using a nested loop over both the training data and the </span>
<span class="sd">        test data.</span>

<span class="sd">        Inputs:</span>
<span class="sd">        - X: A numpy array of shape (num_test, D) containing test data.</span>

<span class="sd">        Returns:</span>
<span class="sd">        - dists: A numpy array of shape (num_test, num_train) where dists[i, j]</span>
<span class="sd">          is the Euclidean distance between the ith test point and the jth training</span>
<span class="sd">          point.</span>
<span class="sd">        &quot;&quot;&quot;</span>

        <span class="n">num_test</span> <span class="o">=</span> <span class="n">X</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">num_train</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">dists</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">zeros</span><span class="p">((</span><span class="n">num_test</span><span class="p">,</span> <span class="n">num_train</span><span class="p">))</span>
        <span class="k">for</span> <span class="n">i</span> <span class="ow">in</span> <span class="n">xrange</span><span class="p">(</span><span class="n">num_test</span><span class="p">):</span>
            <span class="k">if</span> <span class="n">i</span><span class="o">%</span><span class="k">50</span> == 0:
                <span class="nb">print</span><span class="p">(</span><span class="s">&quot;FINISHED WITH TEST IMAGE: &quot;</span><span class="p">,</span><span class="n">i</span><span class="p">)</span>
            <span class="k">for</span> <span class="n">j</span> <span class="ow">in</span> <span class="n">xrange</span><span class="p">(</span><span class="n">num_train</span><span class="p">):</span>
                <span class="n">dists</span><span class="p">[</span><span class="n">i</span><span class="p">,</span> <span class="n">j</span><span class="p">]</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sqrt</span><span class="p">(</span><span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">((</span><span class="n">X</span><span class="p">[</span><span class="n">i</span><span class="p">,</span> <span class="p">:]</span> <span class="o">-</span> <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="p">[</span><span class="n">j</span><span class="p">,</span> <span class="p">:])</span> <span class="o">**</span> <span class="mi">2</span><span class="p">))</span>

        <span class="k">return</span> <span class="n">dists</span>

    <span class="k">def</span> <span class="nf">compute_distances_one_loop</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">X</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Compute the distance between each test point in X and each training point</span>
<span class="sd">        in self.X_train using a single loop over the test data.</span>

<span class="sd">        Input / Output: Same as compute_distances_two_loops</span>
<span class="sd">        &quot;&quot;&quot;</span>
        <span class="n">num_test</span> <span class="o">=</span> <span class="n">X</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">num_train</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">dists</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">zeros</span><span class="p">((</span><span class="n">num_test</span><span class="p">,</span> <span class="n">num_train</span><span class="p">))</span>

        <span class="k">for</span> <span class="n">i</span> <span class="ow">in</span> <span class="n">xrange</span><span class="p">(</span><span class="n">num_test</span><span class="p">):</span>

            <span class="k">if</span> <span class="n">i</span><span class="o">%</span><span class="k">50</span> == 0:
                <span class="nb">print</span><span class="p">(</span><span class="s">&quot;FINISHED WITH TEST IMAGE: &quot;</span><span class="p">,</span><span class="n">i</span><span class="p">)</span>
            <span class="n">dists</span><span class="p">[</span><span class="n">i</span><span class="p">,</span> <span class="p">:]</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sqrt</span><span class="p">(</span><span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">np</span><span class="o">.</span><span class="n">square</span><span class="p">(</span><span class="bp">self</span><span class="o">.</span><span class="n">X_train</span> <span class="o">-</span> <span class="n">X</span><span class="p">[</span><span class="n">i</span><span class="p">,</span> <span class="p">:]),</span> <span class="n">axis</span><span class="o">=</span><span class="mi">1</span><span class="p">))</span>

        <span class="k">return</span> <span class="n">dists</span>

    <span class="k">def</span> <span class="nf">compute_distances_no_loops</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">X</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Compute the distance between each test point in X and each training point</span>
<span class="sd">        in self.X_train using no explicit loops.</span>

<span class="sd">        Input / Output: Same as compute_distances_two_loops</span>
<span class="sd">        &quot;&quot;&quot;</span>
        <span class="n">num_test</span> <span class="o">=</span> <span class="n">X</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">num_train</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">dists</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">zeros</span><span class="p">((</span><span class="n">num_test</span><span class="p">,</span> <span class="n">num_train</span><span class="p">))</span>


        <span class="c"># (x-y)^2 = x^2 + y^2 - 2xy --&gt; test_sum + train_sum - 2*inner_product</span>
        <span class="n">test_sum</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">np</span><span class="o">.</span><span class="n">square</span><span class="p">(</span><span class="n">X</span><span class="p">),</span> <span class="n">axis</span><span class="o">=</span><span class="mi">1</span><span class="p">)</span> <span class="c"># shape -&gt; (500,)</span>
        <span class="n">train_sum</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sum</span><span class="p">(</span><span class="n">np</span><span class="o">.</span><span class="n">square</span><span class="p">(</span><span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="p">),</span> <span class="n">axis</span><span class="o">=</span><span class="mi">1</span><span class="p">)</span> <span class="c"># shape -&gt; (5000,)</span>
        <span class="n">inner_product</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">dot</span><span class="p">(</span><span class="n">X</span><span class="p">,</span> <span class="bp">self</span><span class="o">.</span><span class="n">X_train</span><span class="o">.</span><span class="n">T</span><span class="p">)</span> <span class="c"># shape -&gt; (500,5000)</span>

        <span class="c"># reshape test_sum from (500,) to (500,1) while keeping same data</span>
        <span class="c"># the -1 infers same shape as before (500)</span>
        <span class="n">dists</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">sqrt</span><span class="p">(</span><span class="n">test_sum</span><span class="o">.</span><span class="n">reshape</span><span class="p">(</span><span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="mi">1</span><span class="p">)</span> <span class="o">+</span> <span class="n">train_sum</span> <span class="o">-</span> <span class="mi">2</span><span class="o">*</span><span class="n">inner_product</span><span class="p">)</span>

        <span class="k">return</span> <span class="n">dists</span>

    <span class="k">def</span> <span class="nf">predict_labels</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">dists</span><span class="p">,</span> <span class="n">k</span><span class="o">=</span><span class="mi">1</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Given a matrix of distances between test points and training points,</span>
<span class="sd">        predict a label for each test point.</span>

<span class="sd">        Inputs:</span>
<span class="sd">        - dists: A numpy array of shape (num_test, num_train) where dists[i, j]</span>
<span class="sd">          gives the distance betwen the ith test point and the jth training point.</span>

<span class="sd">        Returns:</span>
<span class="sd">        - y: A numpy array of shape (num_test,) containing predicted labels for the</span>
<span class="sd">          test data, where y[i] is the predicted label for the test point X[i].  </span>
<span class="sd">        &quot;&quot;&quot;</span>
        <span class="n">num_test</span> <span class="o">=</span> <span class="n">dists</span><span class="o">.</span><span class="n">shape</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span>
        <span class="n">y_pred</span> <span class="o">=</span> <span class="n">np</span><span class="o">.</span><span class="n">zeros</span><span class="p">(</span><span class="n">num_test</span><span class="p">)</span>
        <span class="k">for</span> <span class="n">i</span> <span class="ow">in</span> <span class="n">xrange</span><span class="p">(</span><span class="n">num_test</span><span class="p">):</span>
            <span class="c"># A list of length k storing the labels of the k nearest neighbors to</span>
            <span class="c"># the ith test point.</span>
            <span class="n">closest_y</span> <span class="o">=</span> <span class="p">[]</span>

            <span class="c">#while looping through i&#39;s get the distances of each images (i) with every</span>
            <span class="c">#training image and save that as a new numpy array &quot;dists_i&quot;</span>
            <span class="n">dists_i</span> <span class="o">=</span> <span class="n">dists</span><span class="p">[</span><span class="n">i</span><span class="p">]</span>

            <span class="c">#dists_i.argsort() gives the indices of sorted distances, low to high.</span>
            <span class="c">#dists_i.argsort()[:k], gives k lowest distance indices (k Nearest Neighbors)</span>
            <span class="c">#y_train[&quot;this lowest distance indice&quot;] gives the labels of that training img</span>
            <span class="c">#this array closest_y is of len=k</span>
            <span class="n">closest_y</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">y_train</span><span class="p">[</span><span class="n">dists_i</span><span class="o">.</span><span class="n">argsort</span><span class="p">()[:</span><span class="n">k</span><span class="p">]]</span>

            <span class="c">#choose the most common label in closest_y</span>
            <span class="c">#(ties broken with lowest label...Counter does this....)</span>
            <span class="n">y_pred</span><span class="p">[</span><span class="n">i</span><span class="p">]</span> <span class="o">=</span> <span class="n">Counter</span><span class="p">(</span><span class="n">closest_y</span><span class="p">)</span><span class="o">.</span><span class="n">most_common</span><span class="p">(</span><span class="mi">1</span><span class="p">)[</span><span class="mi">0</span><span class="p">][</span><span class="mi">0</span><span class="p">]</span>


        <span class="k">return</span> <span class="n">y_pred</span>
</pre></div>

</div>
</div>
</div>

</div>


			</div> <?php //END OF ARTICLE CONTENT ?>


			</main>
			<footer>
				<section class="comments" style="display: none;">
					<?php
          if(isset($_SESSION['id'])) {
            echo "<form id='commentform' method='POST' action=' ".setComments($conn)." '>
              <input type='hidden' name='uid' value='".$_SESSION['uid']."'>
              <input type='hidden' name='date' value=' ".date('Y-m-d H:i:s')." '>
              <textarea class='commentarea' name='message'></textarea><br>
              <button form='commentform' id='commentbtn' name='commentSubmit' type='submit' value='submit'>Comment</button>
            </form>";
          }
          else {
            echo "<p style='text-align: center;'>You must be logged in to comment!</p>";
          }

          getComments($conn);

          ?>


				</section>
			</footer>
		</article>

		<div class="article-count">ARTICLE 5</div>

	</div>
